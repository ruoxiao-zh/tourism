<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'type',
        'cate_id',
        'title',
        'image',
        'content',
        'is_top',
        'is_index'
    ];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'cate_id', 'id');
    }
}
