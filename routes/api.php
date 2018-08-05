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
        'limit'      => config('api.rate_limits.access.limit'),
        'expires'    => config('api.rate_limits.access.expires'),
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
         * 房间类型管理
         */
        // 添加
        $api->post('hotel-room-types', 'HotelRoomTypesController@store')
            ->name('api.hotel-room-types.store');
        // 更新
        $api->patch('hotel-room-types/{hotelRoomType}', 'HotelRoomTypesController@update')
            ->name('api.hotel-room-types.update');
        // 删除
        $api->delete('hotel-room-types/{hotelRoomType}', 'HotelRoomTypesController@destroy')
            ->name('api.hotel-room-types.destroy');
        // 列表
        $api->get('hotel-room-types', 'HotelRoomTypesController@index')
            ->name('api.hotel-room-types.index');
        // 详情
        $api->get('hotel-room-types/{hotelRoomType}', 'HotelRoomTypesController@show')
            ->name('api.hotel-room-types.show');

        /**
         * 房间管理
         */
        // 添加
        $api->post('hotel-rooms', 'HotelRoomsController@store')
            ->name('api.hotel-rooms.store');
        // 更新
        $api->patch('hotel-rooms/{hotelRoom}', 'HotelRoomsController@update')
            ->name('api.hotels.update');
        // 删除
        $api->delete('hotel-rooms/{hotelRoom}', 'HotelRoomsController@destroy')
            ->name('api.hotel-rooms.destroy');
        // 列表
        $api->get('hotel-rooms', 'HotelRoomsController@index')
            ->name('api.hotel-rooms.index');
        // 详情
        $api->get('hotel-rooms/{hotelRoom}', 'HotelRoomsController@show')
            ->name('api.hotel-rooms.show');

        /**
         * 旅游分类管理
         */
        // 添加
        $api->post('travel-categories', 'TravelCategoriesController@store')
            ->name('api.travel-categories.store');
        // 更新
        $api->patch('travel-categories/{travelCategory}', 'TravelCategoriesController@update')
            ->name('api.travel-categories.update');
        // 删除
        $api->delete('travel-categories/{travelCategory}', 'TravelCategoriesController@destroy')
            ->name('api.travel-categories.destroy');
        // 列表
        $api->get('travel-categories', 'TravelCategoriesController@index')
            ->name('api.travel-categories.index');
        // 详情
        $api->get('travel-categories/{travelCategory}', 'TravelCategoriesController@show')
            ->name('api.travel-categories.show');

        /**
         * 旅游视频管理
         */
        // 添加
        $api->post('travel-videos', 'TravelVideosController@store')
            ->name('api.travel-videos.store');
        // 更新
        $api->patch('travel-videos/{travelVideo}', 'TravelVideosController@update')
            ->name('api.hotel-videos.update');
        // 删除
        $api->delete('travel-videos/{travelVideo}', 'TravelVideosController@destroy')
            ->name('api.travel-videos.destroy');
        // 列表
        $api->get('travel-videos', 'TravelVideosController@index')
            ->name('api.travel-videos.index');
        // 详情
        $api->get('travel-videos/{travelVideo}', 'TravelVideosController@show')
            ->name('api.travel-videos.show');
        // 详情
        $api->get('travel-videos/{travelVideo}', 'TravelVideosController@show')
            ->name('api.travel-videos.show');

        /**
         * 旅游线路管理
         */
        // 添加
        $api->post('travel-lines', 'TravelLinesController@store')
            ->name('api.travel-lines.store');
        // 更新
        $api->patch('travel-lines/{travelLine}', 'TravelLinesController@update')
            ->name('api.hotel-lines.update');
        // 删除
        $api->delete('travel-lines/{travelLine}', 'TravelLinesController@destroy')
            ->name('api.travel-lines.destroy');
        // 列表
        $api->get('travel-lines', 'TravelLinesController@index')
            ->name('api.travel-lines.index');
        // 详情
        $api->get('travel-lines/{travelLine}', 'TravelLinesController@show')
            ->name('api.travel-lines.show');
        // 上架与下架
        $api->get('travel-lines/change-status/{travelLine}', 'TravelLinesController@changeStatus')
            ->name('api.travel-lines.change.status');

        /**
         * 景点取票方式管理
         */
        // 添加
        $api->post('take-tickets-types', 'AttractionsTakeTicketsTypesController@store')
            ->name('api.take-tickets-types.store');
        // 更新
        $api->patch('take-tickets-types/{attractionsTakeTicketsType}', 'AttractionsTakeTicketsTypesController@update')
            ->name('api.take-tickets-types.update');
        // 删除
        $api->delete('take-tickets-types/{attractionsTakeTicketsType}', 'AttractionsTakeTicketsTypesController@destroy')
            ->name('api.take-tickets-types.destroy');
        // 列表
        $api->get('take-tickets-types', 'AttractionsTakeTicketsTypesController@index')
            ->name('api.take-tickets-types.index');
        // 详情
        $api->get('take-tickets-types/{attractionsTakeTicketsType}', 'AttractionsTakeTicketsTypesController@show')
            ->name('api.take-tickets-types.show');

        /**
         * 景区管理
         */
        // 添加
        $api->post('attractions', 'AttractionsController@store')
            ->name('api.attractions.store');
        // 更新
        $api->patch('attractions/{attraction}', 'AttractionsController@update')
            ->name('api.attractions.update');
        // 删除
        $api->delete('attractions/{attraction}', 'AttractionsController@destroy')
            ->name('api.attractions.destroy');
        // 列表
        $api->get('attractions', 'AttractionsController@index')
            ->name('api.attractions.index');
        // 详情
        $api->get('attractions/{attraction}', 'AttractionsController@show')
            ->name('api.attractions.show');

        /**
         * 门票类型管理
         */
        // 添加
        $api->post('ticket-types', 'TicketTypesController@store')
            ->name('api.ticket-types.store');
        // 更新
        $api->patch('ticket-types/{ticketType}', 'TicketTypesController@update')
            ->name('api.ticket-types.update');
        // 删除
        $api->delete('ticket-types/{ticketType}', 'TicketTypesController@destroy')
            ->name('api.ticket-types.destroy');
        // 列表
        $api->get('ticket-types', 'TicketTypesController@index')
            ->name('api.ticket-types.index');
        // 详情
        $api->get('ticket-types/{ticketType}', 'TicketTypesController@show')
            ->name('api.ticket-types.show');

        /**
         * 门票管理
         */
        // 添加
        $api->post('tickets', 'TicketsController@store')
            ->name('api.tickets.store');
        // 更新
        $api->patch('tickets/{ticket}', 'TicketsController@update')
            ->name('api.tickets.update');
        // 删除
        $api->delete('tickets/{ticket}', 'TicketsController@destroy')
            ->name('api.tickets.destroy');
        // 列表
        $api->get('tickets', 'TicketsController@index')
            ->name('api.tickets.index');
        // 详情
        $api->get('tickets/{ticket}', 'TicketsController@show')
            ->name('api.tickets.show');

        /**
         * 会员等级头衔管理
         */
        // 添加
        $api->post('member-title', 'MemberTitleController@store')
            ->name('api.member-title.store');
        // 更新
        $api->patch('member-title/{memberTitle}', 'MemberTitleController@update')
            ->name('api.member-title.update');
        // 删除
        $api->delete('member-title/{memberTitle}', 'MemberTitleController@destroy')
            ->name('api.member-title.destroy');
        // 列表
        $api->get('member-title', 'MemberTitleController@index')
            ->name('api.member-title.index');
        // 详情
        $api->get('member-title/{memberTitle}', 'MemberTitleController@show')
            ->name('api.member-title.show');

        /**
         * 会员管理
         */
        // 添加
        $api->post('members', 'MembersController@store')
            ->name('api.members.store');
        // 更新
        $api->patch('members/{member}', 'MembersController@update')
            ->name('api.members.update');
        // 删除
        $api->delete('members/{member}', 'MembersController@destroy')
            ->name('api.members.destroy');
        // 列表
        $api->get('members', 'MembersController@index')
            ->name('api.members.index');
        // 详情
        $api->get('members/{member}', 'MembersController@show')
            ->name('api.members.show');
        // 会员启用与禁用
        $api->get('members/change-status/{member}', 'MembersController@changeStatus')
            ->name('api.members.change.status');

        /**
         * 轮播图管理
         */
        // 添加
        $api->post('slide-shows', 'SlideShowsController@store')
            ->name('api.slide-shows.store');
        // 更新
        $api->patch('slide-shows/{slideShow}', 'SlideShowsController@update')
            ->name('api.slide-shows.update');
        // 删除
        $api->delete('slide-shows/{slideShow}', 'SlideShowsController@destroy')
            ->name('api.slide-shows.destroy');
        // 列表
        $api->get('slide-shows', 'SlideShowsController@index')
            ->name('api.slide-shows.index');
        // 详情
        $api->get('slide-shows/{slideShow}', 'SlideShowsController@show')
            ->name('api.slide-shows.show');

        /**
         * 微信相关
         */
        // 小程序登录 - 获取 openid
        $api->post('weapp/authorizations', 'WeChatHandlerController@weappStore')
            ->name('api.weapp.authorizations.store');
        // 小程序登录 - 获取 token
        $api->post('weapp/me', 'WeChatHandlerController@me')
            ->name('api.weapp.authorizations.me');

        /**
         * 用户相关
         */
        // 图片验证码
        $api->get('captchas', 'CaptchasController@store')
            ->name('api.captchas.store');
        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 刷新 token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');

        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function ($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 用户注册
            $api->post('users', 'UsersController@store')
                ->name('api.users.store');
            // 用户信息修改
            $api->put('users', 'UsersController@update')
                ->name('api.users.update');

            /**
             * 购物车管理
             */
            // 添加
            $api->post('cart', 'CartController@store')
                ->name('api.cart.store');
            // 更新
            $api->patch('cart/{cart}', 'CartController@update')
                ->name('api.cart.update');
            // 删除
            $api->delete('cart/{cart}', 'CartController@destroy')
                ->name('api.cart.destroy');
            // 列表
            $api->get('cart', 'CartController@index')
                ->name('api.cart.index');
            // 详情
            $api->get('cart/{cart}', 'CartController@show')
                ->name('api.cart.show');

            /**
             * 订单管理
             */
            // 添加, 购物车添加
            $api->post('cart-orders', 'OrdersController@cartStore')
                ->name('api.cart-orders.store');
            // 添加, 直接购买
            $api->post('orders', 'OrdersController@store')
                ->name('api.order.store');
            // 更新
            $api->patch('orders/{order}', 'OrdersController@update')
                ->name('api.orders.update');
            // 删除
            $api->delete('orders/{order}', 'OrdersController@destroy')
                ->name('api.orders.destroy');
            // 列表
            $api->get('orders', 'OrdersController@index')
                ->name('api.orders.index');
            // 详情
            $api->get('orders/{order}', 'OrdersController@show')
                ->name('api.orders.show');

            /**
             * 支付管理
             */
            // 添加, 购物车添加
            $api->post('pay', 'PaymentController@payByWechat')
                ->name('api.pay.store');
        });
        // 微信支付回调
        $api->post('payment/wechat/notify', 'PaymentController@wechatNotify')
            ->name('payment.wechat.notify');

        /**
         * 公共接口
         */
        // 图片上传
        $api->post('images/upload', 'ImageUploadHandlerController@upload')
            ->name('api.images.upload');
    });
});
