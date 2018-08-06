<?php

namespace App\Transformers;

use App\Models\Member;
use League\Fractal\TransformerAbstract;

class MembersTransformer extends TransformerAbstract
{
    public function transform(Member $member)
    {
        return [
            'id'         => $member->id,
            'monetary'   => $member->monetary,
            'title_id'   => (int)$member->title_id,
            'title'      => $member->title->name,
            'discount'   => (int)$member->discount,
            'is_forbid'  => (boolean)$member->is_forbid,
            'created_at' => $member->created_at->toDateTimeString(),
            'updated_at' => $member->updated_at->toDateTimeString(),
        ];
    }
}
