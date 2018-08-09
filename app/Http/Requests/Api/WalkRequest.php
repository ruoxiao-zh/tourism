<?php

namespace App\Http\Requests\Api;

class WalkRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'             => 'required|string|max:255|unique:walk_lines',
                    'image'            => 'required|string|max:255',
                    'walk_category_id' => 'required|numeric',
                    'images'           => 'required|json',
                    'introduce'        => 'required|string',
                    'data'             => 'required|json',
                ];
                break;
            case 'PATCH':
                return [
                    'name'             => 'required|string|max:255',
                    'image'            => 'required|string|max:255',
                    'walk_category_id' => 'required|numeric',
                    'images'           => 'required|json',
                    'introduce'        => 'required|string',
                    'date'             => 'required|json',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'             => '徒步线路名称不能为空',
            'name.string'               => '徒步线路名称必须为字符串类型',
            'name.max'                  => '徒步线路名称最大字符长度不能超过 255 个字符',
            'name.unique'               => '徒步线路名称已经存在',
            'image.required'            => '徒步线路主图不能为空',
            'image.string'              => '徒步线路主图必须为字符串类型',
            'image.max'                 => '徒步线路主图最大字符长度不能超过 255 个字符',
            'walk_category_id.required' => '徒步线路分类 ID 不能为空',
            'walk_category_id.numeric'  => '徒步线路分类 ID 必须为字符串类型',
            'images.required'           => '徒步线路详情图片不能为空',
            'images.json'               => '徒步线路详情图片必须为 json 类型',
            'introduce.required'        => '徒步线路简介不能为空',
            'introduce.string'          => '徒步线路简介必须为字符串类型',
            'data.required'             => '徒步线路日期安排不能为空',
            'data.json'                 => '徒步线路日期安排必须为 json 类型',
        ];
    }
}
