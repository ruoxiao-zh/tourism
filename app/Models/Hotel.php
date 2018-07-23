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
}
