<?php

namespace App\Transformers;

use App\Models\ArticleCategory;
use League\Fractal\TransformerAbstract;

class ArticleCategoryTransformer extends TransformerAbstract
{
    public function transform(ArticleCategory $articleCategory)
    {
        return [
            'id'         => $articleCategory->id,
            'name'       => $articleCategory->name,
            'type'       => $articleCategory->type,
            'created_at' => $articleCategory->created_at->toDateTimeString(),
            'updated_at' => $articleCategory->updated_at->toDateTimeString(),
        ];
    }
}
