<?php

namespace App\Http\Requests\Api;

class CustomerServiceRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nickname' => 'required|string|max:255|unique:customer_service',
                    'qrcode'   => 'required|string|max:255',
                ];
                break;
            case 'PATCH':
                return [
                    'nickname' => 'required|string|max:255',
                    'qrcode'   => 'required|string|max:255',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'nickname.required' => '客服昵称不能为空',
            'nickname.string'   => '客服昵称必须为字符串类型',
            'nickname.max'      => '客服昵称最大字符长度不能超过 255 个字符',
            'nickname.unique'   => '客服昵称已经存在',
            'qrcode.required'   => '客服二维码不能为空',
            'qrcode.string'     => '客服二维码必须为字符串类型',
            'qrcode.max'        => '客服二维码最大字符长度不能超过 255 个字符',
        ];
    }
}
