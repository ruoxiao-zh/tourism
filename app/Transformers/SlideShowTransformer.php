<?php

namespace App\Transformers;

use App\Models\SlideShow;
use League\Fractal\TransformerAbstract;

class SlideShowTransformer extends TransformerAbstract
{
    public function transform(SlideShow $slideShow)
    {
        return [
            'id'         => $slideShow->id,
            'image'      => $slideShow->image,
            'url'        => $slideShow->url,
            'title'      => $slideShow->title,
            'created_at' => $slideShow->created_at->toDateTimeString(),
            'updated_at' => $slideShow->updated_at->toDateTimeString(),
        ];
    }
}
