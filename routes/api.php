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

Route::post('/login', 'API\UserController@login');
Route::post('/send_register', 'API\UserController@register');
Route::post('/logout', 'API\UserController@logout');

Route::post('/password/email', 'API\ForgotPasswordController@sendResetLinkEmail');

Route::post('/password/reset', 'API\ResetPasswordController@reset');

Route::post('/upload', 'API\FileController@upload');

Route::group(['middleware' => 'auth:api'], function(){

	Route::get('/product/popular', 'API\ProductController@popular');

	Route::get('/product/recent', 'API\ProductController@recent');

	Route::post('/product/rating/{id}', 'API\ProductController@store_rating');

	Route::post('/product/{keyword?}{slug?}', 'API\ProductController@show');
	
    Route::post('/send_update', 'API\UserController@update');

	Route::post('/details', 'API\UserController@details');

    Route::post('/history/store', 'API\UserController@store_history');
    Route::get('/product/detail/{slug}', 'API\UserController@product_detail');

	Route::get('/history/show', 'API\UserController@show_history');

	Route::post('/password/change', 'API\ChangePasswordController@change');

	Route::post('/request/product','API\ProductRequestController@dorequest');

	Route::get('/notifications', 'API\UserController@messages');

	Route::get('/notifications/read/{id}', 'API\UserController@read_message');

	Route::get('/notifications/read_all', 'API\UserController@read_all_message');

	Route::get('/recipes', 'API\RecipeController@show_all');
	Route::post('/recipe/{keyword?}{slug?}', 'API\RecipeController@show');

});
