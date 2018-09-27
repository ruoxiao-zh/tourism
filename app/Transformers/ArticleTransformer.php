<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return [
            'id'         => $article->id,
            'type'       => $article->type,
            'cate_id'    => $article->cate_id,
            'category'   => $article->category ? $article->category->name : '',
            'title'      => $article->title,
            'image'      => $article->image,
            'content'    => $article->content,
            'is_top'     => (boolean)$article->is_top,
            'is_index'   => (boolean)$article->is_index,
            'created_at' => $article->created_at->toDateTimeString(),
            'updated_at' => $article->updated_at->toDateTimeString(),
        ];
    }
}
