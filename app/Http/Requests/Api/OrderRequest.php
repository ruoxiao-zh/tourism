<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class OrderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type'           => [
                'required',
                'string',
                Rule::in(['travel', 'hotel', 'ticket']),
            ],
            'date'           => 'required|json',
            'product_sku_id' => 'required|numeric',
            'username'       => 'required|string',
            'phone'          => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
            ],
            'total_amount'   => 'required|numeric',
            'amount'         => 'required|numeric',
            'price'          => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'type.required'           => '订单类型不能为空',
            'type.string'             => '订单类型必须为字符串类型',
            'type.in'                 => '订单类型只能是 [cart] 数组中的值',
            'date.required'           => '预定时间不能为空',
            'date.json'               => '预定时间必须为 json 类型',
            'product_sku_id.required' => '商品 ID 不能为空',
            'product_sku_id.numeric'  => '商品 ID 必须为数字类型',
            'username.required'       => '订单姓名不能为空',
            'username.string'         => '订单姓名必须为字符串类型',
            'phone.required'          => '订单联系方式不能为空',
            'phone.regex'             => '订单联系方式格式不正确',
            'total_amount.required'   => '订单总金额不能为空',
            'total_amount.numeric'    => '订单总金额必须为数字类型',
            'amount.required'         => '商品数量不能为空',
            'amount.numeric'          => '商品数量必须为数字类型',
            'price.required'          => '商品价格不能为空',
            'price.numeric'           => '商品价格必须为数字类型',
        ];
    }
}
