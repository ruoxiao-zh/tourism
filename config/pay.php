<?php

return [
    'wechat' => [
        'app_id'      => env('WECHAT_MINI_PROGRAM_APPID'),   // 小程序 app id
        'mch_id'      => env('WECHAT_MINI_PROGRAM_MCHID'),  // 微信支付商户号
        'key'         => env('WECHAT_MINI_PROGRAM_KEY'), // 微信支付密钥
        'notify_url'  => env('WECHAT_MINI_PROGRAM_NOTIFYURL'),
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
