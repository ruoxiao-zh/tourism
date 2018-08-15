<?php

namespace App\Http\Requests\Api;

class SlideShowRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'image' => 'required|string|max:255|unique:slideshows',
                    'url'   => 'required|string',
                ];
                break;
            case 'PATCH':
                return [
                    'image' => 'required|string|max:255',
                    'url'   => 'required|string',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'image.required' => '轮播图不能为空',
            'image.string'   => '轮播图必须为字符串类型',
            'image.max'      => '轮播图最大字符长度不能超过 255 个字符',
            'image.unique'   => '轮播图名称已经存在',
            'url.required'   => '跳转链接不能为空',
            'url.string'     => '跳转链接必须为字符串类型',
        ];
    }
}
