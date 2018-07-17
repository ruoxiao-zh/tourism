<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
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
}
