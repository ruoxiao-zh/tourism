<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class CheckCoderRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'  => 'required|string|max:100',
                    'phone' => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
                        'unique:check_coders'
                    ],
                    'code'  => 'required|string|max:32|unique:check_coders',
                    'type'  => [
                        'required',
                        Rule::in(['hotel', 'ticket', 'travel']),
                    ]
                ];
                break;
            case 'PATCH':
                return [
                    'name'  => 'required|string|max:100',
                    'phone' => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
                    ],
                    'code'  => 'required|string|max:32',
                    'type'  => [
                        'required',
                        Rule::in(['hotel', 'ticket', 'travel']),
                    ]
                ];
                break;
            case 'GET':
                return [
                    'type'    => [
                        'sometimes',
                        'required',
                        Rule::in(['hotel', 'ticket']),
                    ]
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'  => '核销员姓名不能为空',
            'name.string'    => '核销员姓名必须为字符串类型',
            'name.max'       => '核销员姓名最大字符长度不能超过 100 个字符',
            'phone.required' => '核销员电话不能为空',
            'phone.regex'    => '核销员电话格式不正确',
            'phone.unique'   => '核销员电话已经存在',
            'code.required'  => '核销员专属核销码不能为空',
            'code.string'    => '核销员专属核销码必须为字符串类型',
            'code.max'       => '核销员专属核销码最大字符长度不能超过 32 个字符',
            'code.unique'    => '核销员专属核销码已经存在',
            'type.required'  => '核销员类型不能为空',
            'type.in'        => '核销员类型类型只能是 [hotel, ticket, travel] 数组中的任一值',
        ];
    }
}
