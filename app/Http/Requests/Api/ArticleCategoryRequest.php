<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class ArticleCategoryRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100|unique:article_categories',
                    'type' => [
                        'required',
                        Rule::in(['sports', 'culture']),
                    ]
                ];
                break;
            case 'PATCH':
                return [
                    'name' => 'required|string|max:100',
                    'type' => [
                        'required',
                        Rule::in(['sports', 'culture']),
                    ]
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => '文章分类名称不能为空',
            'name.string'   => '文章分类名称必须为字符串类型',
            'name.max'      => '文章分类名称最大字符长度不能超过 100 个字符',
            'name.unique'   => '文章分类名称已经存在',
            'type.required' => '文章分类类型不能为空',
            'type.in'       => '文章分类类型只能是 [sports, culture] 数组中的任一值',
        ];
    }
}
