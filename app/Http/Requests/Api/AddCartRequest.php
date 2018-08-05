<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class AddCartRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type'                => [
                'required',
                Rule::in(['travel', 'hotel', 'ticket']),
            ],
            'product_sku_id'      => ['required', 'integer'],
            'amount'              => ['required', 'integer', 'min:1'],
            'product_price'       => ['required', 'numeric'],
            'product_total_money' => ['required', 'numeric'],
            'date'                => ['required', 'json'],
        ];
    }

    public function messages()
    {
        return [
            'type.required'                => '商品类型不能为空',
            'type.in'                      => '商品类型只能是 [travel, hotel, ticket] 数组中的一种',
            'product_sku_id.required'      => '商品 ID 不能为空',
            'product_sku_id.integer'       => '商品 ID 只能是整数',
            'amount.required'              => '所购商品数量不能为空',
            'amount.integer'               => '所购商品数量只能是整数',
            'amount.min'                   => '所购商品数量最小值为 1',
            'product_price.required'       => '商品价格不能为空',
            'product_price.numeric'        => '商品价格必须为数字类型',
            'product_total_money.required' => '商品总价不能为空',
            'product_total_money.numeric'  => '商品总价必须为数字类型',
            'date.required'                => '预定时间不能为空',
            'date.json'                    => '预定时间必须为 json 数据类型',
        ];
    }
}
