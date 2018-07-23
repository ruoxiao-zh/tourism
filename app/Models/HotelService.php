<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    protected $table = 'hotel_service';

    protected $fillable = [
        'service_name',
        'hotel_id'
    ];
}
