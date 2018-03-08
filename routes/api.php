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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


$api = app('Dingo\Api\Routing\Router');
$api->version('v1',  ['middleware' => 'api.throttle', 'limit' => 1000, 'expires' => 5], function ($api) {
    $api->group(['namespace' => 'App\Api\V1\Controllers', 'middleware' => ['jwt.api.auth', 'cors']], function ($api) {
        $api->post('/auth/signup', 'AuthController@postSignup');
        $api->post('/auth/login', 'AuthController@postLogin');
        
        
        /* 认证授权相关接口 */
        $api->group(['middleware' => ['jwt.auth', 'api.logs']], function ($api) {
            $api->get('/users', 'TestController@index');
            $api->get('/user/{id}', 'TestController@show');

            $api->get('/auth/apps', 'TestController@apps');
            $api->get('/auth/user', 'AuthController@getUser');
            $api->patch('/auth/refresh', 'AuthController@patchRefresh');
            $api->delete('/auth/invalidate', 'AuthController@deleteInvalidate');

            /* 抽奖相关接口 */
            $api->get('/lotterys', 'LotteryController@index');
            $api->get('/lottery/{id}', 'LotteryController@show');
            $api->get('/lottery/{id}/data', 'LotteryController@datas');
            $api->get('/lottery/{id}/award', 'LotteryController@awards');

            /* 新闻相关接口 */
            $api->get('/news', 'NewsController@index');
            $api->get('/news/latest', 'NewsController@getListLatest');
            $api->get('/news/search', 'NewsController@search');
            $api->get('/news/{id}', 'NewsController@show');
            $api->post('/news/{id}/comment', 'NewsController@postComment');
            $api->get('/channels', 'NewsController@channel');
            $api->get('/channel/{id}/news', 'NewsController@getListByChannel');
        });
    });
});
