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

Route::get('/','BookController@index');
Route::get('/book/{slug}', 'BookController@show');
Route::get('/category/{category}', 'BookController@show_cat');

Route::get('/orders','OrderController@index');
Route::post('/order/create', 'OrderController@create');

Route::post('admin','Auth\LoginController@login');
Route::get('admin', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/add_discount', 'HomeController@add_discount');
