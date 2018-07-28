<?php

namespace App\Http\Requests\Api;

class AttractionRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'                 => 'required|string|max:255|unique:attractions',
                    'image'                => 'required|string|max:255',
                    'province'             => 'required|string|max:100',
                    'city'                 => 'required|string|max:100',
                    'county'               => 'required|string|max:100',
                    'detail'               => 'required|string|max:255',
                    'longitude'            => 'required|numeric',
                    'latitude'             => 'required|numeric',
                    'date'                 => 'required|json',
                    'introduce'            => 'required',
                    'take_tickets_type_id' => 'required|numeric',
                ];
                break;
            case 'PATCH':
                return [
                    'name'                 => 'required|string|max:255',
                    'image'                => 'required|string|max:255',
                    'province'             => 'required|string|max:100',
                    'city'                 => 'required|string|max:100',
                    'county'               => 'required|string|max:100',
                    'detail'               => 'required|string|max:255',
                    'longitude'            => 'required|numeric',
                    'latitude'             => 'required|numeric',
                    'date'                 => 'required|json',
                    'introduce'            => 'required',
                    'take_tickets_type_id' => 'required|numeric',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'                 => '景区名称不能为空',
            'name.string'                   => '景区名称必须为字符串类型',
            'name.max'                      => '景区名称最大字符长度不能超过 255 个字符',
            'name.unique'                   => '景区名称已经存在',
            'image.required'                => '景区图片不能为空',
            'image.string'                  => '景区图片必须为字符串类型',
            'image.max'                     => '景区图片最大字符长度不能超过 255 个字符',
            'province.required'             => '省不能为空',
            'province.string'               => '省必须为字符串类型',
            'province.max'                  => '省最大字符长度不能超过 100 个字符',
            'city.required'                 => '市不能为空',
            'city.string'                   => '市必须为字符串类型',
            'city.max'                      => '市最大字符长度不能超过 100 个字符',
            'county.required'               => '县(区)不能为空',
            'county.string'                 => '县(区)必须为字符串类型',
            'county.max'                    => '县(区)最大字符长度不能超过 100 个字符',
            'detail.required'               => '景区详情不能为空',
            'detail.string'                 => '景区详情必须为字符串类型',
            'detail.max'                    => '景区详情最大字符长度不能超过 255 个字符',
            'longitude.required'            => '经度不能为空',
            'longitude.numeric'             => '经度必须为数字类型',
            'latitude.required'             => '纬度不能为空',
            'latitude.numeric'              => '纬度必须为数字类型',
            'date.required'                 => '开放时间不能为空',
            'date.numeric'                  => '开放时间必须为 json 类型',
            'introduce.required'            => '景区简介不能为空',
            'take_tickets_type_id.required' => '取票方式不能为空',
            'take_tickets_type_id.numeric'  => '取票方式必须为数字类型',
        ];
    }
}
