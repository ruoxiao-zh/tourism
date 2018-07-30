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
                ];
                break;
            case 'PATCH':
                return [
                    'image' => 'required|string|max:255',
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
        ];
    }
}
