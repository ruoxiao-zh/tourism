<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'nickname'   => $user->nickname,
            'avatar'     => $user->avatar,
            'openid'     => $user->openid,
            'integral'   => $user->integral,
            'email'      => $user->email,
            'is_admin'   => (boolean)$user->is_admin,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
    }
}
