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

Route::group(['prefix' => 'admin'], function() {
    Route::group(['namespace' => 'Admin'], function() {
        Route::get('/login', 'LoginController@index')->name('admin.login');
        Route::post('/login', 'LoginController@login')->name('admin.login');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/captcha', 'LoginController@captcha')->name('admin.captcha');
    });

    Route::group(['namespace' => 'Admin', 'middleware' => 'permissionCheck'], function() {
        Route::get('/home', 'HomeController@index')->name('home.index');
        Route::get('/home/password', 'HomeController@edit')->name('password.edit');
        Route::put('/home/password', 'HomeController@update')->name('password.update');

        Route::resource('users', 'UserController', ['except' => 'show']);
        Route::resource('roles', 'RoleController', ['except' => 'show']);
        Route::resource('permissions', 'PermissionController', ['except' => 'show']);
        Route::resource('clients', 'ClientController', ['except' => 'show']);
        Route::resource('lotterys', 'LotteryController', ['except' => 'show']);
        Route::resource('lottos', 'LottoController', ['except' => 'show']);
        Route::resource('awards', 'AwardController', ['except' => ['show', 'index']]);
        Route::resource('news', 'NewsController');
        Route::resource('channels', 'ChannelController', ['except' => 'show']);
        Route::resource('comments', 'CommentController', ['except' => ['show', 'create', 'store']]);
        Route::resource('apps', 'AppController', ['except' => 'show']);

        Route::get('/roles/{role}/permission', 'RoleController@permission')->name('roles.permission');
        Route::post('/roles/{role}/permission', 'RoleController@storePermission')->name('roles.permission');
        Route::get('/users/{user}/role', 'UserController@role')->name('users.role');
        Route::post('/users/{user}/role', 'UserController@storeRole')->name('users.role');
        Route::get('/lotterys/{lottery}/award', 'LotteryController@award')->name('lotterys.award');
        Route::post('/lotterys/{lottery}/award', 'LotteryController@storeAward')->name('lotterys.award');
        Route::get('/lotterys/{lottery}/lotto', 'LotteryController@lotto')->name('lotterys.lotto');
        Route::post('/lotterys/{lottery}/lotto', 'LotteryController@storeLotto')->name('lotterys.lotto');
        Route::get('/lottos/{lotto}/data', 'LottoController@data')->name('lottos.data');
        Route::get('/lottos/{lotto}/import', 'LottoController@import')->name('lottos.import');
        Route::post('/lottos/{lotto}/import', 'LottoController@storeImport')->name('lottos.import');

        Route::delete('/data/{lotto}', 'DataController@destroy')->name('data.destroy');

        Route::get('/channels/{channel}/news', 'ChannelController@news')->name('channels.news');
        Route::post('/news/upload', 'NewsController@imageUpload')->name('news.upload');

        Route::get('/logs', 'LogController@index')->name('logs.index');
        Route::delete('/logs/{log}', 'LogController@destroy')->name('logs.destroy');

        Route::get('/clients/{client}/app', 'ClientController@app')->name('clients.app');
        Route::post('/clients/{client}/app', 'ClientController@storeApp')->name('clients.app');        
    });
});
