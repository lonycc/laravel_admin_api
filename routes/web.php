<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin'], function() {
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');
    Route::get('/captcha', 'LoginController@captcha');
});

Route::group(['namespace' => 'Admin', 'middleware' => 'permissionCheck'], function() {
    Route::get('/home', 'HomeController@index');

    Route::resource('users', 'UserController', ['except' => 'show']);
    Route::resource('roles', 'RoleController', ['except' => 'show']);
    Route::resource('permissions', 'PermissionController', ['except' => 'show']);
    Route::resource('client', 'ClientController', ['except' => 'show']);
    Route::resource('lottery', 'LotteryController', ['except' => 'show']);
    Route::resource('lotto', 'LottoController', ['except' => 'show']);
    Route::resource('award', 'AwardController', ['except' => ['show', 'index']]);
    Route::resource('news', 'NewsController');

    Route::get('/roles/{role}/permission', 'RoleController@permission');
    Route::post('/roles/{role}/permission', 'RoleController@storePermission');
    Route::get('/users/{user}/role', 'UserController@role');
    Route::post('/users/{user}/role', 'UserController@storeRole');
    Route::get('/lottery/{lottery}/award', 'LotteryController@award');
    Route::post('/lottery/{lottery}/award', 'LotteryController@storeAward');
    Route::get('/lottery/{lottery}/lotto', 'LotteryController@lotto');
    Route::post('/lottery/{lottery}/lotto', 'LotteryController@storeLotto');
    Route::get('/lotto/{lotto}/data', 'LottoController@data');
    Route::get('/lotto/{lotto}/import', 'LottoController@import');
    Route::post('/lotto/{lotto}/import', 'LottoController@storeImport');

    Route::delete('/data/{lotto}', 'DataController@destory')->name('data.destory');
});
