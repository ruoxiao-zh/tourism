<?php

namespace App\Http\Requests\Api;

class TicketTypeRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100|unique:ticket_types',
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
            'name.required' => '门派类型不能为空',
            'name.string'   => '门派类型必须为字符串类型',
            'name.max'      => '门派类型最大字符长度不能超过 100 个字符',
            'name.unique'   => '门派类型已经存在',
        ];
    }
}
