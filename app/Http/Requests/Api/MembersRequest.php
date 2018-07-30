<?php

namespace App\Http\Requests\Api;

class MembersRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'monetary' => 'required|numeric|min:0|unique:members',
            'title_id' => 'required|numeric',
            'discount' => 'required|numeric|min:1|max:9',
        ];
    }

    public function messages()
    {
        return [
            'monetary.required' => '消费金额不能为空',
            'monetary.numeric'  => '消费金额必须为数字类型',
            'monetary.min'      => '消费金额最小不能低于 0 元',
            'monetary.unique'   => '消费金额已经存在',
            'title_id.required' => '会员头衔不能为空',
            'title_id.numeric'  => '会员头衔必须为数字类型',
            'discount.required' => '消费折扣不能为空',
            'discount.numeric'  => '消费折扣必须为数字类型',
            'discount.min'      => '消费折扣最小不能低于一折',
            'discount.max'      => '消费折扣最大不能高于九折',
        ];
    }
}
