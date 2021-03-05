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

Auth::routes();
Route::get('/', 'HomeController@index')->middleware('auth')->name('home');
Route::get('/clientip', 'HomeController@index')->name('clientip');
Route::post('/submitip','HomeController@submit');
Route::post('/editip','HomeController@editClient');
Route::post('/deleteClient','HomeController@deleteclient');
