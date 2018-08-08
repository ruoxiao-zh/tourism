<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';

    protected $fillable = [
        'name',
        'image',
        'province',
        'city',
        'county',
        'detail',
        'longitude',
        'latitude',
        'contact',
        'introduce',
        'cate_id',
        'is_delete'
    ];

    public function category()
    {
        return $this->belongsTo(HotelCategory::class, 'cate_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(HotelService::class, 'hotel_id', 'id');
    }

    public function getMinPrice()
    {
        return HotelRoom::where('hotel_id', $this->id)->min('price');
    }

    public function rooms()
    {
        $rooms = HotelRoom::where('hotel_id', $this->id)->get();
        if ($rooms) {
            foreach ($rooms as $key => $room) {
                $images = HotelRoomImage::where('hotel_room_id', $room->id)->first();
                if ($images) {
                    ($rooms[$key])->image = $images->image;
                }
                $types = HotelRoomType::where('id', $room->hotel_room_id)->first();
                if ($types) {
                    ($rooms[$key])->type = $types->type;
                }
            }
        }

        return $rooms;
    }
}
