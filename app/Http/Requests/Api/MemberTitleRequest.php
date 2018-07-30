<?php

namespace App\Http\Requests\Api;

class MemberTitleRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:100|unique:member_title',
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
            'name.required' => '会员等级名称不能为空',
            'name.string'   => '会员等级名称必须为字符串类型',
            'name.max'      => '会员等级名称最大字符长度不能超过 100 个字符',
            'name.unique'   => '会员等级名称已经存在',
        ];
    }
}
