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

        /**
         * 文章分类管理
         */
        // 添加
        $api->post('article-categories', 'ArticleCategoriesController@store')
            ->name('api.article-categories.store');
        // 更新
        $api->patch('article-categories/{articleCategory}', 'ArticleCategoriesController@update')
            ->name('api.article-categories.update');
        // 删除
        $api->delete('article-categories/{articleCategory}', 'ArticleCategoriesController@destroy')
            ->name('api.article-categories.destroy');
        // 列表
        $api->get('article-categories', 'ArticleCategoriesController@index')
            ->name('api.article-categories.index');
        // 详情
        $api->get('article-categories/{articleCategory}', 'ArticleCategoriesController@show')
            ->name('api.article-categories.show');

        /**
         * 文章管理
         */
        $api->post('articles', 'ArticlesController@store')
            ->name('api.articles.store');
        // 更新
        $api->patch('articles/{article}', 'ArticlesController@update')
            ->name('api.articles.update');
        // 删除
        $api->delete('articles/{article}', 'ArticlesController@destroy')
            ->name('api.articles.destroy');
        // 列表
        $api->get('articles', 'ArticlesController@index')
            ->name('api.articles.index');
        // 详情
        $api->get('articles/{article}', 'ArticlesController@show')
            ->name('api.articles.show');

        /**
         * 公共接口
         */
        // 图片上传
        $api->post('images/upload', 'ImageUploadHandlerController@upload')
            ->name('api.images.upload');
    });
});
