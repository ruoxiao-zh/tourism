<?php

namespace App\Http\Requests\Api;

class TravelLineRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'date'    => 'required|json',
                    'name'    => 'required|string|max:100|unique:travel_lines',
                    'price'   => 'required|numeric',
                    'cate_id' => 'required|numeric',
                ];
                break;
            case 'PATCH':
                return [
                    'date'    => 'required|json',
                    'name'    => 'required|string|max:100',
                    'price'   => 'required|numeric',
                    'cate_id' => 'required|numeric',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'date.required'    => '发团时间不能为空',
            'date.json'        => '发团时间必须为 json 类型',
            'name.required'    => '线路名称不能为空',
            'name.string'      => '线路名称必须为字符串类型',
            'name.max'         => '线路名称最大字符长度不能超过 100 个字符',
            'name.unique'      => '线路名称已经存在',
            'price.required'   => '线路价格不能为空',
            'price.numeric'    => '线路价格必须为数字类型',
            'cate_id.required' => '所属旅游分类 ID 不能为空',
            'cate_id.numeric'  => '所属旅游分类 ID 必须为数字类型',
        ];
    }
}
