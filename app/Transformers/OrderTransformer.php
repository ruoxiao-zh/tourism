<?php

namespace App\Transformers;

use App\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    public function transform(Order $order)
    {
        return [
            'id'            => $order->id,
            'no'            => $order->no,
            'user_id'       => $order->user_id,
            'username'      => $order->username,
            'phone'         => $order->phone,
            'type'          => $order->type,
            'total_amount'  => $order->total_amount,
            'remark'        => $order->remark,
            'order_status'  => $order->orderStatus(),
            'order_item'    => $order->items(),
            'paid_at'       => $order->paid_at,
            'payment_no'    => $order->payment_no,
            'refund_status' => $order->refundStatus(),
            'refund_reason' => $order->refund_reason,
            'created_at'    => $order->created_at->toDateTimeString(),
            'updated_at'    => $order->updated_at->toDateTimeString(),
        ];
    }
}
