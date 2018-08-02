<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class AddCartRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type'           => [
                'required',
                Rule::in(['travel', 'hotel', 'ticket']),
            ],
            'product_sku_id' => ['required', 'integer'],
            'amount'         => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'type.required'           => '商品类型不能为空',
            'type.in'                 => '商品类型只能是 [travel, hotel, ticket] 数组中的一种',
            'product_sku_id.required' => '商品 ID 不能为空',
            'product_sku_id.integer'  => '商品 ID 只能是整数',
            'amount.required'         => '所购商品数量不能为空',
            'amount.integer'          => '所购商品数量只能是整数',
            'amount.min'              => '所购商品数量最小值为 1',
        ];
    }
}
