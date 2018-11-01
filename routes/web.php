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
//主页
Route::get('/','StaticPagesController@home')->name('home');
Route::get('/fap','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');

Route::get('signUp','UsersController@create')->name('signUp');
Route::resource('users', 'UsersController');

Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');


