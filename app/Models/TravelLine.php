<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelLine extends Model
{
    protected $table = 'travel_lines';

    protected $fillable = [
        'date',
        'name',
        'price',
        'cate_id',
        'status',
        'is_delete',
    ];

    public function category()
    {
        return $this->belongsTo(TravelCategory::class, 'cate_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(TravelLineImage::class, 'travel_line_id', 'id');
    }
}
