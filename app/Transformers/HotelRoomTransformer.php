<?php

namespace App\Transformers;

use App\Models\HotelRoom;
use League\Fractal\TransformerAbstract;

class HotelRoomTransformer extends TransformerAbstract
{
    public function transform(HotelRoom $hotelRoom)
    {
        return [
            'id'         => $hotelRoom->id,
            'name'       => $hotelRoom->name,
            'pid'        => (int)$hotelRoom->pid,
            'created_at' => $hotelRoom->created_at->toDateTimeString(),
            'updated_at' => $hotelRoom->updated_at->toDateTimeString(),
        ];
    }
}
