<?php

namespace App\Transformers;

use App\Models\TravelVideo;
use League\Fractal\TransformerAbstract;

class TravelVideoTransformer extends TransformerAbstract
{
    public function transform(TravelVideo $travelVideo)
    {
        return [
            'id'         => $travelVideo->id,
            'video'      => $travelVideo->video,
            'type'       => $travelVideo->type,
            'created_at' => $travelVideo->created_at->toDateTimeString(),
            'updated_at' => $travelVideo->updated_at->toDateTimeString(),
        ];
    }
}
