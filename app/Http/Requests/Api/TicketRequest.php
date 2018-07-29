<?php

namespace App\Http\Requests\Api;

class TicketRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'attraction_id'  => 'required|numeric',
            'ticket_type_id' => 'required|numeric',
            'price'          => 'required|numeric|min:0',
            'stock'          => 'required|numeric|min:1',
            'needs_to_know'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'attraction_id.required'  => '所属景区不能为空',
            'attraction_id.numeric'   => '所属景区必须为数字类型',
            'ticket_type_id.required' => '门票类型不能为空',
            'ticket_type_id.numeric'  => '门票类型必须为数字类型',
            'price.required'          => '门票价格不能为空',
            'price.numeric'           => '门票价格必须为数字类型',
            'price.min'               => '门票价格最低不能低于 0 元',
            'stock.required'          => '门票库存不能为空',
            'stock.numeric'           => '门票库存必须为数字类型',
            'stock.min'               => '门票价格最低不能低于 1',
            'needs_to_know.required'  => '购票须知不能为空',
        ];
    }
}
