<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth', 'namespace' => 'Api\v1'], function (){
	Route::resource('user', 'UserController');
});

Route::group(['middlewareGroups' => ['web'], 'middleware' => 'auth', 'namespace' => 'User'], function (){
	Route::post('/setting/photo', 'SettingController@updatePhoto');
	Route::post('/setting/contact', 'SettingController@updateContactInfo');
	Route::resource('setting', 'SettingController');
});