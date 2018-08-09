<?php

namespace App\Transformers;

use App\Models\WalkCategory;
use League\Fractal\TransformerAbstract;

class WalkCategoryTransformer extends TransformerAbstract
{
    public function transform(WalkCategory $walk)
    {
        return [
            'id'         => $walk->id,
            'name'       => $walk->name,
            'pid'        => (int)$walk->pid,
            'created_at' => $walk->created_at->toDateTimeString(),
            'updated_at' => $walk->updated_at->toDateTimeString(),
        ];
    }
}
