<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;

class ArticleRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'type'    => [
                        'required',
                        Rule::in(['sports', 'culture']),
                    ],
                    'cate_id' => 'required|numeric',
                    'title'   => 'required|string|max:255|unique:articles',
                    'image'   => 'required|string|max:255',
                    'content' => 'required',
                ];
                break;
            case 'PATCH':
                return [
                    'type'    => [
                        'required',
                        Rule::in(['sports', 'culture']),
                    ],
                    'cate_id' => 'required|numeric',
                    'title'   => 'required|string|max:255',
                    'image'   => 'required|string|max:255',
                    'content' => 'required',
                ];
                break;
            case 'GET':
                return [
                    'type'    => [
                        'sometimes',
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
            'type.required'    => '文章分类类型不能为空',
            'type.in'          => '文章分类类型只能是 [sports, culture] 数组中的任一值',
            'cate_id.required' => '文章分类不能为空',
            'cate_id.numeric'  => '文章分类必须是数字',
            'title.required'   => '文章标题不能为空',
            'title.string'     => '文章标题必须为字符串类型',
            'title.max'        => '文章标题最大字符长度不能超过 255 个字符',
            'title.unique'     => '文章标题已经存在',
            'image.required'   => '文章图片不能为空',
            'image.string'     => '文章图片必须为字符串类型',
            'image.max'        => '文章图片最大字符长度不能超过 255 个字符',
            'name.unique'      => '文章分类名称已经存在',
            'content.required' => '文章内容不能为空',
        ];
    }
}
