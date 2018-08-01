<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Auth;
use App\Http\Controllers\Controller as BaseController;

/**
 * API 基类
 *
 * Class Controller
 * @package App\Http\Controllers\Api
 */
class Controller extends BaseController
{
    use Helpers;

    public function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
