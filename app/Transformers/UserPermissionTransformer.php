<?php

namespace App\Transformers;

use App\Models\UserPermission;
use League\Fractal\TransformerAbstract;

class UserPermissionTransformer extends TransformerAbstract
{
    public function transform(UserPermission $userPermission)
    {
        return [
            'id'         => $userPermission->id,
            'user_id'    => $userPermission->user_id,
            'user_name'  => $userPermission->user ? $userPermission->user->name : '',
            'permission' => $userPermission->permission,
            'created_at' => $userPermission->created_at->toDateTimeString(),
            'updated_at' => $userPermission->updated_at->toDateTimeString(),
        ];
    }
}
