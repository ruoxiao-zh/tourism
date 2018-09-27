<?php

namespace App\Transformers;

use App\Models\WalkLine;
use League\Fractal\TransformerAbstract;

class WalkTransformer extends TransformerAbstract
{
    public function transform(WalkLine $walkLine)
    {
        return [
            'id'               => $walkLine->id,
            'name'             => $walkLine->name,
            'image'            => $walkLine->image,
            'walk_category_id' => (int)$walkLine->walk_category_id,
            'walk_category'    => $walkLine->category ? $walkLine->category->name : '',
            'is_index'         => (boolean)$walkLine->is_index,
            'walk_detail'      => $walkLine->detail(),
            'created_at'       => $walkLine->created_at->toDateTimeString(),
            'updated_at'       => $walkLine->updated_at->toDateTimeString(),
        ];
    }
}
