<?php

namespace App\Http\Requests\Api;

class HotelRoomTypeRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'type' => 'required|string|max:100|unique:hotel_room_types',
                ];
                break;
            case 'PATCH':
                return [
                    'type' => 'required|string|max:100',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'type.required' => '酒店房间类型不能为空',
            'type.string'   => '酒店房间类型必须为字符串类型',
            'type.max'      => '酒店房间类型最大字符长度不能超过 100 个字符',
            'type.unique'   => '酒店房间类型已经存在',
        ];
    }
}
