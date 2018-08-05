<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ApplyRefundRequest;
use App\Http\Requests\Api\CartOrderRequest;
use App\Http\Requests\Api\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ticket;
use App\Transformers\OrderTransformer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrdersController extends Controller
{
    /**
     * 购物车提交订单
     *
     * @param CartOrderRequest $request
     * @param Order            $order
     * @param OrderItem        $orderItem
     *
     * @return \Dingo\Api\Http\Response
     */
    public function cartStore(CartOrderRequest $request, Order $order, OrderItem $orderItem)
    {
        \DB::transaction(function () use ($request, $order, $orderItem) {
            $data = array_merge($request->all(), ['user_id' => $this->user()->id]);
            $order->fill($data);
            $order->save();

            $cart_id_array = json_decode($request->cart_id, true);
            $cartIds = [];
            foreach ($cart_id_array as $key => $value) {
                $cart = Cart::find($value['cart_id']);
                // 旅游门票
                if ($cart->type === 'ticket') {
                    $ticket = Ticket::find($cart->product_sku_id);
                    if (($ticket->stock - $cart->amount) < 0) {
                        throw new \Dingo\Api\Exception\StoreResourceFailedException('商品库存不足');
                    }
                    // 减库存
                    Ticket::where('id', $cart->product_sku_id)->where('stock', '>=', $cart->amount)->decrement('stock', $cart->amount);
                }
                $cartIds[] = $value['cart_id'];

                $orderItem->insert([
                    'order_id'    => $order->id,
                    'product_id'  => $cart->product_sku_id,
                    'amount'      => $cart->amount,
                    'price'       => $cart->product_price,
                    'total_money' => $cart->product_total_money,
                    'type'        => $cart->type,
                    'date'        => $cart->date,
                ]);

                // 购物车订单提交完了把购物车清空
                Cart::whereIn('id', $cartIds)->where('user_id', $this->user()->id)->delete();
            }
        });

        return $this->response->item($order, new OrderTransformer())
            ->setStatusCode(201);
    }

    /**
     * 直接下单
     *
     * @param OrderRequest $request
     * @param Order        $order
     * @param OrderItem    $orderItem
     *
     * @return \Dingo\Api\Http\Response
     */
    public function store(OrderRequest $request, Order $order, OrderItem $orderItem)
    {
        \DB::transaction(function () use ($request, $order, $orderItem) {
            $data = array_merge($request->all(), ['user_id' => $this->user()->id]);
            $order->fill($data);
            $order->save();

            // 旅游门票
            if ($request->type === 'ticket') {
                $ticket = Ticket::find($request->product_sku_id);
                if (($ticket->stock - $request->amount) < 0) {
                    throw new \Dingo\Api\Exception\StoreResourceFailedException('商品库存不足');
                }
                // 减库存
                Ticket::where('id', $request->product_sku_id)->where('stock', '>=', $request->amount)->decrement('stock', $request->amount);
            }

            $orderItem->insert([
                'order_id'    => $order->id,
                'product_id'  => $request->product_sku_id,
                'amount'      => $request->amount,
                'price'       => $request->price,
                'total_money' => $request->total_amount,
                'type'        => $request->type,
                'date'        => $request->date,
            ]);
        });

        return $this->response->item($order, new OrderTransformer())
            ->setStatusCode(201);
    }

    public function applyRefund(ApplyRefundRequest $request)
    {
        // 校验订单是否属于当前用户
        $order = Order::where(['user_id' => $this->user()->id, 'id' => $request->order_id])->first();
        if (!$order) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('订单不存在');

        }
        // 判断订单是否已付款
        if (!$order->paid_at) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('该订单未支付，不可退款');
        }
        // 订单状态 (0: 未支付 1:已支付 2: 已发货 3: 确认收货, 完成 4: 申请退款 5: 退款完成)
        // 判断订单退款状态是否正确
        if ($order->refund_status) {
            throw new \Dingo\Api\Exception\StoreResourceFailedException('该订单已经申请过退款，请勿重复申请');
        }
        // 将用户输入的退款理由放到订单的 extra 字段中
        $refund_reason = $request->input('reason');
        // 将订单退款状态改为已申请退款
        $order->update([
            'refund_status' => 'applying',
            'refund_reason' => $refund_reason,
            'order_status'  => 4
        ]);

        return $order;
    }
}
