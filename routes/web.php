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

Route::get('/', 'LaundryController@index');
Route::post('/newlaundry', 'LaundryController@insert')->name('newLaundry');
Route::post('/deletelaundry', 'LaundryController@delete')->name('deleteLaundry');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
