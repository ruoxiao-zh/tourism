<?php

namespace App\Http\Requests\Api;

class ApplyRefundRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'order_id' => 'required|numeric',
            'reason'   => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'order_id.required' => '订单 ID 不能为空',
            'order_id.numeric'  => '订单 ID 必须为数字类型',
            'reason.required'   => '申请退款原因不能为空',
            'reason.string'     => '申请退款原因必须为字符串数据类型',
        ];
    }
}
