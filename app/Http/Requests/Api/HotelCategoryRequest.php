<?php

namespace App\Http\Requests\Api;

class HotelCategoryRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:50|unique:hotel_categories',
                ];
                break;
            case 'PATCH':
                return [
                    'name' => 'required|string|max:255',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '酒店分类名称不能为空',
            'name.string'   => '酒店分类名称必须为字符串类型',
            'name.max'      => '酒店分类名称最大字符长度不能超过 50 个字符',
            'name.unique'   => '酒店分类名称已经存在',
        ];
    }
}
