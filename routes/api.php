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
        // 添加
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
        // 获取指定文章分类下的文章
        $api->get('article-categories/{articleCategory}/articles', 'ArticlesController@categoryArticles')
            ->name('api.article-categories.articles');
        // 置顶与取消置顶
        $api->get('articles/change-top/{article}', 'ArticlesController@changeTop')
            ->name('api.articles.change.top');
        // 推荐首页与取消推荐首页
        $api->get('articles/change-index/{article}', 'ArticlesController@changeIndex')
            ->name('api.articles.change.index');

        /**
         * 客服管理
         */
        // 添加
        $api->post('customer-services', 'CustomerServicesController@store')
            ->name('api.customer-services.store');
        // 更新
        $api->patch('customer-services/{customerService}', 'CustomerServicesController@update')
            ->name('api.customer-services.update');
        // 删除
        $api->delete('customer-services/{customerService}', 'CustomerServicesController@destroy')
            ->name('api.customer-services.destroy');
        // 列表
        $api->get('customer-services', 'CustomerServicesController@index')
            ->name('api.customer-services.index');
        // 详情
        $api->get('customer-services/{customerService}', 'CustomerServicesController@show')
            ->name('api.customer-services.show');

        /**
         * 核销员管理
         */
        // 添加
        $api->post('check-coders', 'CheckCodersController@store')
            ->name('api.check-coders.store');
        // 更新
        $api->patch('check-coders/{checkCoder}', 'CheckCodersController@update')
            ->name('api.check-coders.update');
        // 删除
        $api->delete('check-coders/{checkCoder}', 'CheckCodersController@destroy')
            ->name('api.check-coders.destroy');
        // 列表
        $api->get('check-coders', 'CheckCodersController@index')
            ->name('api.check-coders.index');
        // 详情
        $api->get('check-coders/{checkCoder}', 'CheckCodersController@show')
            ->name('api.check-coders.show');
        // 禁用与启用
        $api->get('check-coders/change-status/{checkCoder}', 'CheckCodersController@changeStatus')
            ->name('api.check-coders.change.status');

        /**
         * 酒店分类管理
         */
        // 添加
        $api->post('hotel-categories', 'HotelCategoriesController@store')
            ->name('api.hotel-categories.store');
        // 更新
        $api->patch('hotel-categories/{hotelCategory}', 'HotelCategoriesController@update')
            ->name('api.hotel-categories.update');
        // 删除
        $api->delete('hotel-categories/{hotelCategory}', 'HotelCategoriesController@destroy')
            ->name('api.hotel-categories.destroy');
        // 列表
        $api->get('hotel-categories', 'HotelCategoriesController@index')
            ->name('api.hotel-categories.index');
        // 详情
        $api->get('hotel-categories/{hotelCategory}', 'HotelCategoriesController@show')
            ->name('api.hotel-categories.show');

        /**
         * 酒店管理
         */
        // 添加
        $api->post('hotels', 'HotelsController@store')
            ->name('api.hotels.store');
        // 更新
        $api->patch('hotels/{hotel}', 'HotelsController@update')
            ->name('api.hotels.update');
        // 删除
        $api->delete('hotels/{hotel}', 'HotelsController@destroy')
            ->name('api.hotels.destroy');
        // 列表
        $api->get('hotels', 'HotelsController@index')
            ->name('api.hotels.index');
        // 详情
        $api->get('hotels/{hotel}', 'HotelsController@show')
            ->name('api.hotels.show');

        /**
         * 公共接口
         */
        // 图片上传
        $api->post('images/upload', 'ImageUploadHandlerController@upload')
            ->name('api.images.upload');
    });
});
