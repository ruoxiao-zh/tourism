<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'     => 'required|string|max:255|unique:users',
                    'password' => 'required|string|min:6',
                    'email'    => [
                        'required',
                        'regex:/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/',
                        'unique:users',
                    ]
                ];
                break;
            case 'PUT':
                $userId = \Auth::guard('api')->id();
                return [
                    'name'     => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('users')->ignore($userId, 'id')
                    ],
                    'password' => 'required|string|min:6',
                    'email'    => [
                        'required',
                        'regex:/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/',
                        Rule::unique('users')->ignore($userId, 'id')
                    ]
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'     => '用户名不能为空',
            'name.string'       => '用户名必须为字符串类型',
            'name.max'          => '用户名最大字符长度不能超过 255 个字符',
            'name.unique'       => '用户名已存在, 请更换其它用户名',
            'password.required' => '密码不能为空',
            'password.string'   => '密码必须为字符串类型',
            'password.min'      => '密码最小字符长度不能低于 6 个字符',
            'email.required'    => '邮箱不能为空',
            'email.regex'       => '邮箱格式不正确',
            'email.unique'      => '邮箱已经存在, 请更换新的邮箱',
        ];
    }
}
