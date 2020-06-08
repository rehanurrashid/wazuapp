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

// Admin Routes

Route::match(['get','post'],'/home', 'HomeController@index');

Route::post('send/notification', 'HomeController@send_notification')->name('send.notification');

Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

Route::middleware('auth','check.role:admin,vendor')->group(function () {

  Route::get('dashboard-ecommerce','AdminController@index')->name('admin.dashboard');
	Route::get('/dashboard-analytics','DashboardController@dashboardAnalytics');

  Route::get('acount-settings/{id}/edit','AdminController@edit')->name('admin.account.edit');
  Route::put('acount-settings/{id}','AdminController@update')->name('admin.account.update');

  	Route::get('acount-settings/{id}/edit','AdminController@edit')->name('admin.account.edit');
  	Route::put('acount-settings/{id}','AdminController@update')->name('admin.account.update');

  	Route::resource('manage_vendors', 'VendorController');

  	Route::resource('customers', 'CustomerController');

  	Route::resource('categories','CategoryController');

  	Route::resource('products','ProductController');

    Route::resource('recipes','RecipeController');

    Route::resource('popular_products','PopularProductController');

    Route::resource('messages','MessageController');

  	Route::get('product/import','ProductController@import_products')->name('import-products');
  	Route::post('product/import','ProductController@store_import_products')->name('store-import-products');

    Route::resource('plans','PlanController');
    Route::resource('ProductRequests','ProductRequestController');

});


// Auth::routes();

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => 'password.update',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// User Routes

Route::get('/', 'HomeController@home')->name('home');
Route::post('/register', 'UserActionController@register')->name('register');
Route::post('/login', 'UserActionController@login')->name('user.login');
Route::post('/activate-plan', 'UserActionController@activate_plan')->name('activate-plan');
Route::get('privacy-policy', 'HomeController@privacy_policy')->name('privacy-policy');
Route::get('terms-conditions', 'HomeController@terms_conditions')->name('terms-conditions');
Route::get('contact-us', 'HomeController@contact_us')->name('contact-us');