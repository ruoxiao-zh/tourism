<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
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
        // miniapp 方法为拉起小程序支付
        return app('wechat_pay')->miniapp([
            'out_trade_no' => $order->no,  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee'    => $order->total_amount * 100, // 与支付宝不同，微信支付的金额单位是分。
            'body'         => '山地旅游黔西南小程序订单：' . $order->no, // 订单描述
            'openid'       => $this->user()->openid, // 当前支付用户的 openid
        ]);
    }

    /**
     * 微信支付回调
     *
     * @return string
     */
    public function wechatNotify()
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

        // 将订单标记为已支付
        $order->update([
            'paid_at'      => Carbon::now(),
            'payment_no'   => $data->transaction_id,
            'order_status' => 1,
        ]);

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
        $order = Order::where(['user_id' => $this->user()->id, 'id' => $request->order_id])->first();
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
}
