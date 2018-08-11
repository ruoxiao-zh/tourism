<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UserRequest;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    /**
     * 用户详情
     *
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer());
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'password' => bcrypt($request->password),
            'email'    => $request->email,
            'is_admin' => 1,
        ]);

        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type'   => 'Bearer',
                'expires_in'   => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }

    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'password', 'email']);

//        if ($request->avatar_image_id) {
//            $image = Image::find($request->avatar_image_id);
//
//            $attributes['avatar'] = $image->path;
//        }
        $user->update([
            'name'     => $request->name,
            'password' => bcrypt($request->password),
            'email'    => $request->email,
            'is_admin' => 1,
        ]);

        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => \Auth::guard('api')->fromUser($user),
                'token_type'   => 'Bearer',
                'expires_in'   => \Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(200);
    }

    public function creditsExchange()
    {
        $user = User::find($this->user()->id);
        $user->update([
            'monetary' => $user->integral,
            'integral' => 0
        ]);

        return $this->response->item($this->user(), new UserTransformer());
    }
}
