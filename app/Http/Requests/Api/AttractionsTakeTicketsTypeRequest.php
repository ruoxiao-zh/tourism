<?php

namespace App\Http\Requests\Api;

class AttractionsTakeTicketsTypeRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100|unique:attractions_take_tickets_types',
                ];
                break;
            case 'PATCH':
                return [
                    'name' => 'required|string|max:100',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '景点取票方式不能为空',
            'name.string'   => '景点取票方式必须为字符串类型',
            'name.max'      => '景点取票方式最大字符长度不能超过 100 个字符',
            'name.unique'   => '景点取票方式已经存在',
        ];
    }
}
