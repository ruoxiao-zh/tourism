<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelCategory extends Model
{
    protected $table = 'travel_categories';

    protected $fillable = [
        'name',
        'pid'
    ];

    public function travelLines()
    {
        return $this->hasMany(TravelLine::class, 'cate_id', 'id');
    }
}
