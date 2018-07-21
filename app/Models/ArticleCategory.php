<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_categories';

    protected $fillable = [
        'name',
        'type'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'cate_id', 'id');
    }
}
