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
    Route::get('/roles/{role}/permission', 'RoleController@permission');
    Route::post('/roles/{role}/permission', 'RoleController@storePermission');
    Route::get('/users/{user}/role', 'UserController@role');
    Route::post('/users/{user}/role', 'UserController@storeRole');
});
