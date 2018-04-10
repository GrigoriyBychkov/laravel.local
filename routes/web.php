<?php

use App\Category;
use App\Product;

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
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/changePassword', 'ProfileController@showChangePasswordForm')->name('change_password');
    Route::post('/profile/changePassword', 'ProfileController@changePassword')->name('password_changed');
    Route::get('/profile', 'ProfileController@index')->name('profile_index');
    Route::post('/profile', 'ProfileController@profileUpdate')->name('profile_save');
    Route::get('/news/{id}', 'HomeController@show')->name('news_show_customer');
    Route::get('/goods/{category_id?}', 'HomeController@showGoods')->name('goods_show_customer');
    Route::get('/goods/show/{id}', 'ShoppingCart@productShow')->name('show_product');
    Route::post('/goods/show/{id}', 'ShoppingCart@productOrder')->name('product.order');
    Route::get('/basket', 'ShoppingCart@basket')->name('basket');
    Route::post('/basket', 'ShoppingCart@acceptOrder')->name('accept_order');
    Route::get('/delete/order/{id}', 'ShoppingCart@orderDelete')->name('order_delete');
    Route::get('/my_orders', 'HomeController@myOrders')->name('my_orders_customer');
});

Route::prefix('admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/users', 'UserController@index')->name('users');
        Route::get('/users/edit/{id}', 'UserController@edit')->name('users_edit');
        Route::patch('/users/edit/{id}', 'UserController@edit')->name('user_edit');
        Route::get('/users/block/{id}', 'UserController@block')->name('user_block');
        Route::get('/', 'AdminController@index')->name('admin');
        Route::get('/users/delete/{id}', 'UserController@delete')->name('user_delete');
        Route::get('/users/add', 'UserController@add')->name('users_add');
        Route::post('/users/add', 'UserController@add')->name('user_add');
        Route::get('/news/archive/{id}', 'NewsController@archive')->name('news_archive');
        Route::get('/attachments/delete/{id}', 'NewsController@deleteAttachment')->name('attachment_delete');
        Route::resource('news', 'NewsController');
        Route::resource('categories', 'CategoryController');
        Route::resource('product', 'ProductController', ['except' => ['show']]);
        Route::get('/orders', 'HomeController@adminPageOrders')->name('admin_page_orders');
    });
});





