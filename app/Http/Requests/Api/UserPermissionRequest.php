<?php

namespace App\Http\Requests\Api;

class UserPermissionRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_id'    => 'required|numeric',
            'permission' => 'required|json'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required'    => '所属管理员不能为空',
            'user_id.numeric'     => '管理员 ID 必须是数字类型',
            'permission.required' => '权限不能为空',
            'permission.numeric'  => '权限必须是 json 类型',
        ];
    }
}
