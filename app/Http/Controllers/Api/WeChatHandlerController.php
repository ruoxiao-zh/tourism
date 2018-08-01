<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WeappAuthorizationRequest;
use App\Http\Requests\Api\WeappLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class WeChatHandlerController extends Controller
{
    public function weappStore(WeappAuthorizationRequest $request)
    {
        // 根据 code 获取微信 openid 和 session_key
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($request->code);

        // 如果结果错误，说明 code 已过期或不正确，返回 401 错误
        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 不正确');
        }

        return $this->response->array($data);
    }

    public function me(WeappLoginRequest $request)
    {
        // 找到 openid 对应的用户
        $user = User::where('openid', $request->openid)->first();
        if (!$user) {
            $user = new User();
            $user->fill($request->all());
            $user->save();
        } else {
            $user->update($request->all());
        }

        // 为对应用户创建 JWT
        $token = \Auth::guard('api')->fromUser($user);

        return $this->respondWithToken($token)->setStatusCode(201);
    }
}
