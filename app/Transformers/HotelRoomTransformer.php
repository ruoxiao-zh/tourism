<?php

namespace App\Transformers;

use App\Models\HotelRoom;
use League\Fractal\TransformerAbstract;

class HotelRoomTransformer extends TransformerAbstract
{
    public function transform(HotelRoom $hotelRoom)
    {
        return [
            'id'                 => $hotelRoom->id,
            'price'              => $hotelRoom->price,
            'dining_standard'    => $hotelRoom->dining_standard,
            'broadband'          => $hotelRoom->broadband,
            'area'               => $hotelRoom->area,
            'floor'              => $hotelRoom->floor,
            'number'             => $hotelRoom->number,
            'window'             => $hotelRoom->window,
            'bed_type'           => $hotelRoom->bed_type,
            'pay'                => $hotelRoom->pay,
            'hotel_id'           => $hotelRoom->hotel_id,
            'hotel'              => $hotelRoom->hotel ? $hotelRoom->hotel->name : '',
            'hotel_room_type_id' => $hotelRoom->hotel_room_type_id,
            'hotel_room_type'    => $hotelRoom->hotelRoomType ? $hotelRoom->hotelRoomType->type : '',
            'images'             => $hotelRoom->images,
            'sold_time'          => $hotelRoom->isSold(),
            'created_at'         => $hotelRoom->created_at->toDateTimeString(),
            'updated_at'         => $hotelRoom->updated_at->toDateTimeString(),
        ];
    }
}
