<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    protected $table = 'hotel_categories';

    protected $fillable = ['name'];
}
