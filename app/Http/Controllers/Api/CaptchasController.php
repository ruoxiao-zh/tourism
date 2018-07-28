<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchasController extends Controller
{
    public function store(Request $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . str_random(15);

        // 验证码存到缓存里
        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(5);
        \Cache::put($key, ['code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key'           => $key,
            'code'                  => $captcha->getPhrase(),
            'expired_at'            => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
