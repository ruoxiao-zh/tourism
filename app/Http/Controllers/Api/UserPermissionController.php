<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserPermissionRequest;
use App\Models\UserPermission;
use App\Transformers\UserPermissionTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function store(UserPermissionRequest $request, UserPermission $userPermission)
    {
        $permission = json_decode($request->permission, true);
        foreach ($permission as $key => $value) {
            $is_own = $userPermission->where([
                'user_id'    => $request->user_id,
                'permission' => $value['permission'],
            ])->first();
            if (!$is_own) {
                $userPermission->insert([
                    'user_id'    => $request->user_id,
                    'permission' => $value['permission'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        $query = $userPermission->query();
        $userPermission = $query->where('user_id', $request->user_id)->paginate(15);

        return $this->response->paginator($userPermission, new UserPermissionTransformer());
    }

    public function destroy(UserPermission $userPermission)
    {
        $userPermission->delete();

        return $this->response->noContent();
    }

    public function userPermission(Request $request, UserPermission $userPermission)
    {
        $query = $userPermission->query();
        $userPermission = $query->where('user_id', $request->user_id)->get();

        return $this->response->collection($userPermission, new UserPermissionTransformer());
    }
}
