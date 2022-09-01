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

Route::get('/', 'FrontendController@index');
Route::get('about', 'FrontendController@about');
Route::get('contact', 'FrontendController@contact');
Route::get('product/details/{product_id}', 'FrontendController@productdetails');
Route::get('category/wise/product/{product_id}', 'FrontendController@categorywiseproduct');
Route::get('add/to/cart/{product_id}', 'FrontendController@addtocart');
Route::get('cart', 'FrontendController@cart');
Route::get('cart/{coupon_name}', 'FrontendController@cart');
Route::get('erase/cart', 'FrontendController@erasecart');
Route::get('single/cart/delete/{cart_id}', 'FrontendController@singlecartdelete');
Route::post('update/cart', 'FrontendController@updatecart');
Route::get('customer/register', 'FrontendController@customerregister');
Route::post('customer/register/insert', 'FrontendController@customerregisterinsert');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Backend Routes
Route::get('product/join/view', 'ProductController@productjoinview');
Route::post('product/join/push', 'ProductController@productjoinpush');
Route::get('product/erase/{product_id}', 'ProductController@producterase');
Route::get('product/upgrade/{product_id}', 'ProductController@productupgrade');
Route::post('product/upgrade/push', 'ProductController@productupgradepush');

// category backend routes
Route::get('category/join/view', 'CategoryController@categoryjoinview');
Route::post('category/join/push', 'CategoryController@categoryjoinpush');
Route::get('category/erase/{product_id}', 'CategoryController@categoryerase');
Route::get('category/upgrade/{product_id}', 'CategoryController@categoryupgrade');
Route::post('category/upgrade/push', 'CategoryController@categoryupgradepush');

// coupon backend routes
Route::get('coupon/join/view', 'CouponController@couponjoinview');
Route::post('coupon/join/push', 'CouponController@couponjoinpush');

// Customer backend routes
Route::get('customer/dashboard', 'CustomerController@customerdashboard');
