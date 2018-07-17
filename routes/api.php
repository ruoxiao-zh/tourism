<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace'  => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings']
], function ($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit'      => config('api.rate_limits.sign.limit'),
        'expires'    => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        // 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');

        /**
         * 公司管理
         */
        // 添加
        $api->post('companies', 'CompaniesController@store')
            ->name('api.companies.store');
        // 更新
        $api->patch('companies/{company}', 'CompaniesController@update')
            ->name('api.companies.update');
        // 删除
        $api->delete('companies/{company}', 'CompaniesController@destroy')
            ->name('api.companies.destroy');
        // 列表
        $api->get('companies', 'CompaniesController@index')
            ->name('api.companies.index');
        // 详情
        $api->get('companies/{company}', 'CompaniesController@show')
            ->name('api.companies.show');
    });
});
