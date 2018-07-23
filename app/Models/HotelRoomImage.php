<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomImage extends Model
{
    protected $table = 'hotel_room_images';

    protected $fillable = [
        'image',
        'hotel_room_id',
    ];
}
