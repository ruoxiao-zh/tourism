<?php

namespace App\Http\Controllers\Api;

use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Models\HotelRoomReservationInfo;
use App\Models\HotelRoomType;
use App\Models\Member;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Models\TravelLine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;

class PaymentController extends Controller
{
    /**
     * 微信支付
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function payByWechat(Request $request)
    {
        // 校验订单权限
        if (!$order = Order::where([
            'id'      => $request->order_id,
            'user_id' => $this->user()->id,
        ])->first()) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('订单非法');
        }
        // 校验订单状态
        if ($order->order_status != 0) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('订单状态不正确');
        }
        // 支付金额
        $total_amount = (int)($order->total_amount * 100);
        // 判断当前用户的会员资格, 如果满足发生价格优惠
        $user = User::find($this->user()->id);
        $members = Member::orderBy('monetary', 'desc')->get();
        foreach ($members as $key => $value) {
            if ($user->monetary >= $value->monetary) {
                // 会员资格
                if (!$value->is_forbid) {
                    $total_amount = (int)ceil($total_amount * $value->discount / 10);
                }
            }
        }
        // miniapp 方法为拉起小程序支付
        return app('wechat_pay')->miniapp([
            'out_trade_no' => $order->no,  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee'    => $total_amount, // 与支付宝不同，微信支付的金额单位是分。
            'body'         => '山地旅游黔西南小程序订单：' . $order->no, // 订单描述
            'openid'       => $this->user()->openid, // 当前支付用户的 openid
        ]);
    }

    // 微信支付回调
    public function wechatNotify(EasySms $easySms)
    {
        // 校验回调参数是否正确
        $data = app('wechat_pay')->verify();
        // 找到对应的订单
        $order = Order::where('no', $data->out_trade_no)->first();
        // 订单不存在则告知微信支付
        if (!$order) {
            return 'fail';
        }
        // 订单已支付
        if ($order->paid_at) {
            // 告知微信支付此订单已处理
            return app('wechat_pay')->success();
        }
        $order_items = OrderItem::where('order_id', $order->id)->get();
        $goods_list = [];
        if ($order_items) {
            foreach ($order_items as $key => $item) {
                switch ($item->type) {
                    case 'travel':
                        // 名称
                        $travel = TravelLine::find($item->product_id);
                        $goods_list[] = $travel->name . '旅游线路';
                        break;
                    case 'ticket':
                        // 图片
                        $ticket = Ticket::where('id', $item->product_id)->first();
                        $attraction = Attraction::find($ticket->attraction_id);
                        // 名称
                        $goods_list[] = $attraction->name . '旅游门票';
                        break;
                    case 'hotel':
                        // 名称
                        $hotel_room = HotelRoom::find($item->product_id);
                        $hotel = Hotel::where('id', $hotel_room->hotel_id)->first();
                        $hotel_room_type = HotelRoomType::where('id', $hotel_room->hotel_room_type_id)->first();
                        $goods_list[] = $hotel->name . $hotel_room_type->type . '房间';
                        // 酒店房间预订信息写入到酒店预订信息数据库
                        foreach ($item->date as $k => $v) {
                            HotelRoomReservationInfo::create([
                                'hotel_room_id' => $hotel_room->id,
                                'date'          => $v['date'],
                            ]);
                        }

                        break;
                }
                $goods_list = implode(',', $goods_list);
            }
        }

        // 将订单标记为已支付
        $order->update([
            'paid_at'      => Carbon::now(),
            'payment_no'   => $data->transaction_id,
            'order_status' => 1,
        ]);

        // 将用户消费金额写入用户积分
        $user = User::find($order->user_id);
        User::where('id', $order->user_id)->update([
            'integral' => $user->integral + $order->total_amount
        ]);

        // 发送短信
        try {
            $easySms->send($order->phone, [
                'template' => env('ALIYUN_PAY_SUCCESS_TEMPLATE', ''),
                'data'     => [
                    'name'    => '山地旅游黔西南小程序',
                    'content' => $goods_list
                ],
            ]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('aliyun')->getMessage();

            return $this->response->errorInternal($message ?? '短信发送异常');
        }

        return app('wechat_pay')->success();
    }

    /**
     * 微信退款
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function payRefund(Request $request)
    {
        // 校验订单是否属于当前用户
        $order = Order::where(['id' => $request->order_id])->first();
        if (!$order) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('订单不存在');
        }

        if ($order->refund_status != 'applying' || $order->order_status != 4) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('该订单尚未申请退款');
        }

        app('wechat_pay')->refund([
            'type'          => 'miniapp',
            'out_trade_no'  => $order->no, // 商户订单流水号
            'out_refund_no' => time(),
            'total_fee'     => $order->total_amount * 100, // 订单金额
            'refund_fee'    => $order->total_amount * 100, // 退款金额
            'refund_desc'   => '山地旅游黔西南小程序订单退款：' . $order->no,
        ]);

        // 将订单状态改成退款中
        $refundNo = Order::getAvailableRefundNo();
        $order->update([
            'refund_no'     => $refundNo,
            'refund_status' => 'success',
            'order_status'  => 5,
        ]);

        return $this->response->array(['refund_status' => 'success'])
            ->setStatusCode(200);
    }

    /**
     * 订单发货
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function goodsDeliver(Request $request)
    {
        // 校验订单是否属于当前用户
        $order = Order::where(['id' => $request->order_id])->first();
        if (!$order) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('订单不存在');
        }
        // 订单状态 (0: 未支付 1:已支付 2: 已发货 3: 确认收货, 完成 4: 申请退款 5: 退款完成)
        if ($order->order_status == 1) {
            $order->update([
                'order_status' => 2,
            ]);

            return $this->response->array(['delivery_status' => 'success'])
                ->setStatusCode(200);
        }

        if ($order->order_status == 2) {
            return $this->response->array(['delivery_status' => 'success'])
                ->setStatusCode(200);
        }

        throw new \Dingo\Api\Exception\StoreResourceFailedException('订单状态不符合规范');
    }
}
