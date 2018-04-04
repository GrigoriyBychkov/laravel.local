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
Auth::routes();

Route::group(['middleware'=>['auth']], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile/changePassword','ProfileController@showChangePasswordForm')->name('change_password');
    Route::post('/profile/changePassword','ProfileController@changePassword')->name('password_changed');
    Route::get('/profile','ProfileController@index')->name('profile_index');
    Route::post('/profile','ProfileController@profileUpdate')->name('profile_save');
    Route::get('/news/{id}', 'HomeController@show')->name('news_show_customer');
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
        Route::resource('product', 'ProductController');
    });
});





