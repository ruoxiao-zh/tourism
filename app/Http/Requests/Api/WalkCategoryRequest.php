<?php

namespace App\Http\Requests\Api;

class WalkCategoryRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100|unique:walk_categories',
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
            'name.required' => '徒步线路名称不能为空',
            'name.string'   => '徒步线路名称必须为字符串类型',
            'name.max'      => '徒步线路名称最大字符长度不能超过 100 个字符',
            'name.unique'   => '徒步线路名称已经存在',
        ];
    }
}
