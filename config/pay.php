<?php

return [
    'wechat' => [
        'app_id'      => 'wx1e748438f70b2f01',   // 小程序 app id
        'mch_id'      => '1509193851',  // 微信支付商户号
        'key'         => 'vp0uj404qixypmgajtt0m0s3kd0qflzc', // 微信支付密钥
        // 'notify_url'  => env('WECHAT_MINI_PROGRAM_NOTIFYURL', ''),
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
