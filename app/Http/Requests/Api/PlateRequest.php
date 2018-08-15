<?php

namespace App\Http\Requests\Api;

class PlateRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'  => 'required|string|unique:plate',
                    'image' => 'required|string|max:255',
                    'url'   => 'required|string',
                ];
                break;
            case 'PATCH':
                return [
                    'name'  => 'required|string',
                    'image' => 'required|string|max:255',
                    'url'   => 'required|string',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'  => '版块名称不能为空',
            'name.string'    => '版块名称必须为字符串类型',
            'name.unique'    => '版块名称已经存在',
            'image.required' => '板块图片不能为空',
            'image.string'   => '板块图片必须为字符串类型',
            'image.max'      => '板块图片最大字符长度不能超过 255 个字符',
            'url.required'   => '板块链接地址不能为空',
            'url.string'     => '板块链接地址必须为字符串类型',
        ];
    }
}
