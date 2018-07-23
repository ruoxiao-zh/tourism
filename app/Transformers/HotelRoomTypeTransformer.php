<?php

namespace App\Transformers;

use App\Models\HotelRoomType;
use League\Fractal\TransformerAbstract;

class HotelRoomTypeTransformer extends TransformerAbstract
{
    public function transform(HotelRoomType $hotelRoomType)
    {
        return [
            'id'         => $hotelRoomType->id,
            'type'       => $hotelRoomType->type,
            'pid'        => (int)$hotelRoomType->pid,
            'created_at' => $hotelRoomType->created_at->toDateTimeString(),
            'updated_at' => $hotelRoomType->updated_at->toDateTimeString(),
        ];
    }
}
