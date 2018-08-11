<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalkCategory extends Model
{
    protected $table = 'walk_categories';

    protected $fillable = [
        'name',
        'pid'
    ];

    public function walks()
    {
        return $this->hasMany(WalkLine::class, 'walk_category_id', 'id');
    }
}
