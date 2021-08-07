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

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::get('/', 'ItemsController@index')->name('items.index');
Route::get('cart', 'CartController@cartIndex')->name('cart.index');
Route::group(['prefix' => 'item/{id}'], function () {
    Route::get('item', 'ItemsController@show')->name('items.show');
    Route::post('add', 'CartController@store')->name('item.add');
    // Route::post('addQuantity', 'CartController@addQuantity')->name('item.addQuantity');
    Route::delete('delete', 'CartController@destroy')->name('item.delete');
    Route::put('item', 'ItemsController@update')->name('admin_item.update');
    Route::delete('item', 'ItemsController@destroy')->name('admin_item.delete');
});

Route::group(['prefix' => 'cart_item/{id}'], function () {
    Route::get('update', 'CartController@update')->name('cart_item.update');
    Route::post('add', 'CartController@store')->name('cart_item.add');
    Route::delete('delete', 'CartController@destroy')->name('cart_item.delete');
});
Route::group(['prefix' => 'user/{id}'], function(){
    Route::get('user', 'UsersController@userShow')->name('user.show');
    Route::put('user', 'UsersController@userUpdate')->name('user.update');
    Route::delete('user', 'UsersController@userDelete')->name('user.delete');
});
Route::get('accountDeleted', 'UsersController@accountDeleted');


Route::get('order', 'OrderController@orderInfo')->name('order.get');
Route::post('order', 'OrderController@order')->name('order');
Route::get('order_complete', 'OrderController@orderComplete');


Route::get('add_product_screen', 'ItemsController@showAddProduct')->name('add_product_screen');
Route::post('add_product', 'ItemsController@addProduct')->name('add_product');

Route::group(['prefix' => 'category/{id}'], function () {
    Route::get('category', 'ItemsController@category')->name('category.show');
});

Route::get('searchIndex', 'ItemsController@searchIndex')->name('searchIndex');

Route::get('admin_orderInfo', 'OrderController@admin_orderInfo')->name('admin_orderInfo');