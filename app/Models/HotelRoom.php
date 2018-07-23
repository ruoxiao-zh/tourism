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

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }

    public function hotelRoomType()
    {
        return $this->belongsTo(HotelRoomType::class, 'hotel_room_type_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(HotelRoomImage::class, 'hotel_room_id', 'id');
    }
}
