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
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
//    Route::get('/users/makeadmin', 'UserController@edit')->name('users.make.admin');
});
Route::get('/admin', 'AdminController@index')->middleware('admin')->name('admin');
Route::patch('/users/edit/{id}', 'UserController@edit');

//Route::patch('/users/edit/{id}','UserController@update')->middleware('admin')->name('update');





//Route::get('new-news', 'NewsController@create')->name('create');
//Route::post('new-news', 'NewsController@store')->name('store');
//Route::get('edit/{slug}', 'NewsController@edit')->name('edit');
//Route::post('update', 'NewsController@update')->name('update');



//    Route::prefix('admin')->group(function (){
//        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
//        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
//        Route::get('/', 'AdminController@index')->name('admin.dashboard');
//    });
//
//Route::group(['middleware' => ['auth']], function()
//{Route::get('/login', 'HomeController@');
