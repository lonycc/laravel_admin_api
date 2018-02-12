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
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\V1\Controllers', 'middleware' => 'jwt.api.auth'], function ($api) {
        $api->post('/auth/signup', 'AuthController@postSignup');
        $api->post('/auth/login', 'AuthController@postLogin');

        $api->get('/lotterys', 'LotteryController@index');
        $api->get('/lottery/{id}', 'LotteryController@show');
        $api->get('/lottery/{id}/data', 'LotteryController@datas');
        $api->get('/lottery/{id}/award', 'LotteryController@awards');

        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            $api->get('/users', 'TestController@index');
            $api->get('/user/{id}', 'TestController@show');
            $api->get('/auth/user', 'AuthController@getUser');
            $api->patch('/auth/refresh', 'AuthController@patchRefresh');
            $api->delete('/auth/invalidate', 'AuthController@deleteInvalidate');
        });
    });
});
