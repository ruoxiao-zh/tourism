<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomType extends Model
{
    protected $table = 'hotel_room_types';

    protected $fillable = [
        'type'
    ];
}
