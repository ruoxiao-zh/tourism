<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomReservationInfo extends Model
{
    protected $table = 'hotel_room_reservation_info';

    protected $fillable = [
        'hotel_room_id',
        'date',
    ];
}
