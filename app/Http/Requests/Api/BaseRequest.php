<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

/**
 * 验证器基类
 *
 * Class BaseRequest
 * @package App\Http\Requests\Api
 */
class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
}
