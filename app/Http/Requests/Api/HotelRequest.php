<?php

namespace App\Http\Requests\Api;

class HotelRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'      => 'required|string|max:255|unique:hotels',
                    'image'     => 'required|string|max:255',
                    'province'  => 'required|string|max:100',
                    'city'      => 'required|string|max:100',
                    'county'    => 'required|string|max:100',
                    'detail'    => 'required|string|max:255',
                    'longitude' => 'required|numeric',
                    'latitude'  => 'required|numeric',
                    'contact'   => 'required|string|max:20',
                    'introduce' => 'required',
                    'cate_id'   => 'required|numeric',
                    'services'  => 'required|json',
                ];
                break;
            case 'PATCH':
                return [
                    'name'      => 'required|string|max:255',
                    'image'     => 'required|string|max:255',
                    'province'  => 'required|string|max:100',
                    'city'      => 'required|string|max:100',
                    'county'    => 'required|string|max:100',
                    'detail'    => 'required|string|max:255',
                    'longitude' => 'required|numeric',
                    'latitude'  => 'required|numeric',
                    'contact'   => 'required|string|max:20',
                    'introduce' => 'required',
                    'cate_id'   => 'required|numeric',
                    'services'  => 'required|json',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required'      => '酒店名称不能为空',
            'name.string'        => '酒店名称必须为字符串类型',
            'name.max'           => '酒店名称最大字符长度不能超过 255 个字符',
            'name.unique'        => '酒店名称已存在',
            'image.required'     => '酒店图片不能为空',
            'image.string'       => '酒店图片必须为字符串类型',
            'image.max'          => '酒店图片最大字符长度不能超过 255 个字符',
            'province.required'  => '省不能为空',
            'province.string'    => '省必须为字符串类型',
            'province.max'       => '省最大字符长度不能超过 100 个字符',
            'city.required'      => '市不能为空',
            'city.string'        => '市必须为字符串类型',
            'city.max'           => '市最大字符长度不能超过 100 个字符',
            'county.required'    => '县(区)不能为空',
            'county.string'      => '县(区)必须为字符串类型',
            'county.max'         => '县(区)最大字符长度不能超过 100 个字符',
            'detail.required'    => '地址详情不能为空',
            'detail.string'      => '地址详情必须为字符串类型',
            'detail.max'         => '地址详情最大字符长度不能超过 100 个字符',
            'longitude.required' => '经度不能为空',
            'longitude.numeric'  => '经度必须为数字类型',
            'latitude.required'  => '纬度不能为空',
            'latitude.numeric'   => '纬度必须为数字类型',
            'contact.required'   => '联系方式不能为空',
            'contact.string'     => '联系方式必须为字符串类型',
            'contact.max'        => '联系方式最大字符长度不能超过 20 个字符',
            'introduce.required' => '酒店简介不能为空',
            'cate_id.required'   => '酒店所属分类不能为空',
            'cate_id.numeric'    => '酒店所属分类必须为数字类型',
            'services.required'  => '酒店特色服务不能为空',
            'services.json'      => '酒店特色服务必须为 json 数据类型',
        ];
    }
}
