<?php

namespace App\Http\Requests\Api;

class WeappLoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'openid'   => 'required|string',
            'nickname' => 'required|string',
            'avatar'   => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'openid.required'   => 'openid 不能为空',
            'openid.string'     => 'openid 必须为字符串类型',
            'nickname.required' => '微信用户昵称不能为空',
            'nickname.string'   => '微信用户昵称必须为字符串类型',
            'avatar.required'   => '微信用户头像不能为空',
            'avatar.string'     => '微信用户头像必须为字符串类型',
        ];
    }
}
