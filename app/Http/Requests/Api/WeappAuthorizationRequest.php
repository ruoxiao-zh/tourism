<?php

namespace App\Http\Requests\Api;

class WeappAuthorizationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'code' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'code 码不能为空',
            'code.string'   => 'code 码必须为字符串类型',
        ];
    }
}
