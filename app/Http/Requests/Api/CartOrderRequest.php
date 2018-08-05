<?php

namespace App\Http\Requests\Api;

use App\Models\Cart;
use Illuminate\Validation\Rule;

class CartOrderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type'         => [
                'required',
                'string',
                Rule::in(['cart']),
            ],
            'cart_id'      => [
                'required',
                'json',
                function ($attribute, $value, $fail) {
                    $cart_items = json_decode($value, true);
                    foreach ($cart_items as $cart_item) {
                        if (!$cart = Cart::where([
                            'id'      => $cart_item['cart_id'],
                            'user_id' => $this->user()->id
                        ])->first()) {
                            $fail('该购物车 ID 不存在');

                            return;
                        }
                    }
                }
            ],
            'username'     => 'required|string',
            'phone'        => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
            ],
            'total_amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'type.required'         => '订单类型不能为空',
            'type.string'           => '订单类型必须为字符串类型',
            'type.in'               => '订单类型只能是 [cart] 数组中的值',
            'cart_id.required'      => '购物车 ID 不能为空',
            'username.required'     => '订单姓名不能为空',
            'username.string'       => '订单姓名必须为字符串类型',
            'phone.required'        => '订单联系方式不能为空',
            'phone.regex'           => '订单联系方式格式不正确',
            'total_amount.required' => '订单总金额不能为空',
            'total_amount.numeric'  => '订单总金额必须为数字类型',
        ];
    }
}
