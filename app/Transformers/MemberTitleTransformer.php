<?php

namespace App\Transformers;

use App\Models\MemberTitle;
use League\Fractal\TransformerAbstract;

class MemberTitleTransformer extends TransformerAbstract
{
    public function transform(MemberTitle $memberTitle)
    {
        return [
            'id'         => $memberTitle->id,
            'name'       => $memberTitle->name,
            'created_at' => $memberTitle->created_at->toDateTimeString(),
            'updated_at' => $memberTitle->updated_at->toDateTimeString(),
        ];
    }
}
