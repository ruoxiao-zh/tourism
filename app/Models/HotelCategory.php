<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelCategory extends Model
{
    protected $table = 'hotel_categories';

    protected $fillable = ['name'];

    public function hotels()
    {
        return $this->hasMany(Hotel::class, 'cate_id', 'id');
    }
}
