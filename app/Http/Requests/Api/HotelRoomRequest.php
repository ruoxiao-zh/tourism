<?php

namespace App\Http\Requests\Api;

class HotelRoomRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'price'              => 'required|numeric',
            'dining_standard'    => 'required|string|max:100',
            'broadband'          => 'required|numeric',
            'area'               => 'required|numeric',
            'floor'              => 'required|string|max:100',
            'number'             => 'required|numeric',
            'window'             => 'required|string|max:100',
            'bed_type'           => 'required|string|max:100',
            'pay'                => 'required|string|max:100',
            'hotel_id'           => 'required|numeric',
            'hotel_room_type_id' => 'required|numeric',
            'images'             => 'required|json',
        ];
    }

    public function messages()
    {
        return [
            'price.required'              => '房间价格不能为空',
            'price.numeric'               => '房间价格必须为数字类型',
            'dining_standard.required'    => '餐标不能为空',
            'dining_standard.string'      => '餐标必须为字符串类型',
            'dining_standard.max'         => '餐标最大 100 个字符长度',
            'broadband.required'          => '宽带不能为空',
            'broadband.numeric'           => '宽带必须为数字类型',
            'area.required'               => '房间面积不能为空',
            'area.numeric'                => '房间面积必须为数字类型',
            'floor.required'              => '楼层不能为空',
            'floor.string'                => '楼层必须为字符串类型',
            'floor.max'                   => '楼层最大 100 个字符长度',
            'number.required'             => '房间号不能为空',
            'number.numeric'              => '房间号必须为数字类型',
            'window.required'             => '窗户不能为空',
            'window.string'               => '窗户必须为字符串类型',
            'window.max'                  => '窗户最大 100 个字符长度',
            'bed_type.required'           => '床型不能为空',
            'bed_type.string'             => '床型必须为字符串类型',
            'bed_type.max'                => '床型最大 100 个字符长度',
            'pay.required'                => '支付不能为空',
            'pay.string'                  => '支付必须为字符串类型',
            'pay.max'                     => '支付最大 100 个字符长度',
            'hotel_id.required'           => '酒店 ID 不能为空',
            'hotel_id.numeric'            => '酒店 ID 必须为数字类型',
            'hotel_room_type_id.required' => '房间类型 ID 不能为空',
            'hotel_room_type_id.numeric'  => '房间类型 ID 必须为数字类型',
            'image.required'              => '酒店图片不能为空',
            'image.json'                  => '酒店图片必须为 json 数据类型',
        ];
    }
}
