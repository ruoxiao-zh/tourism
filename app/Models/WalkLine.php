<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalkLine extends Model
{
    protected $table = 'walk_lines';

    protected $fillable = [
        'name',
        'image',
        'walk_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(WalkCategory::class, 'walk_category_id', 'id');
    }

    public function detail()
    {
        $walk_detail = WalkLineDetail::where('walk_id', $this->id)->first();
        if ($walk_detail) {
            $walk_detail->images = json_decode($walk_detail->images, true);
            $walk_detail->data = json_decode($walk_detail->data, true);
        }

        return $walk_detail;
    }
}
