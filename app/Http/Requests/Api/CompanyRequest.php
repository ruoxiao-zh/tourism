<?php

namespace App\Http\Requests\Api;

class CompanyRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'      => 'required|string|max:100',
                    'logo'      => 'required|string|max:255',
                    'phone'     => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
                        'unique:companies'
                    ],
                    'address'   => 'required|string|max:255',
                    'introduce' => 'required',
                ];
                break;
            case 'PATCH':
                return [
                    'name'      => 'required|string|max:100',
                    'logo'      => 'required|string|max:255',
                    'phone'     => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\\d{8}$/',
                    ],
                    'address'   => 'required|string|max:255',
                    'introduce' => 'required',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'      => '公司名称不能为空',
            'name.string'        => '公司名称必须为字符串类型',
            'name.max'           => '公司名称最大字符长度不能超过 100 个字符',
            'logo.required'      => '公司 logo 不能为空',
            'logo.string'        => '公司 logo 必须为字符串类型',
            'logo.max'           => '公司 logo 最大字符长度不能超过 255 个字符',
            'phone.required'     => '公司电话不能为空',
            'phone.regex'        => '公司电话格式不正确',
            'phone.unique'       => '公司电话已存在',
            'address.required'   => '公司地址不能为空',
            'address.string'     => '公司地址必须为字符串类型',
            'address.max'        => '公司地址最大字符长度不能超过 255 个字符',
            'introduce.required' => '公司简介不能为空',
        ];
    }
}
