<?php

namespace App\Http\Requests\Api;

class TravelCategoryRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100|unique:travel_categories',
                ];
                break;
            case 'PATCH':
                return [
                    'name' => 'required|string|max:100',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '旅游分类名称不能为空',
            'name.string'   => '旅游分类名称必须为字符串类型',
            'name.max'      => '旅游分类名称最大字符长度不能超过 100 个字符',
            'name.unique'   => '旅游分类名称已经存在',
        ];
    }
}
