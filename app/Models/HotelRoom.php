<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    protected $table = 'hotel_rooms';

    protected $fillable = [
        'price',
        'dining_standard',
        'broadband',
        'area',
        'floor',
        'number',
        'window',
        'bed_type',
        'pay',
        'hotel_id',
        'hotel_room_type_id',
    ];
}
