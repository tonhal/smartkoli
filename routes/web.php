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

use App\Http\Controllers\GuestController;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'LaundryController@index');
    Route::post('/newlaundry', 'LaundryController@insert')->name('newLaundry');
    Route::post('/deletelaundry', 'LaundryController@delete')->name('deleteLaundry');

    Route::post('/newguest', 'GuestController@insert')->name('newGuest');
    Route::post('/deleteguest', 'GuestController@delete')->name('deleteGuest');
    Route::get('/guests', 'GuestController@index');

    Route::get('/files', 'FileController@index');
    Route::post('/newfile', 'FileController@store')->name('newFile');
    Route::get('files/{uuid}/download', 'FileController@download')->name('downloadFile');
    //Route::post('/deletelaundry', 'LaundryController@delete')->name('deleteFile');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    
});


Route::group(['middleware' => 'guest'], function () {
    Auth::routes();
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');
});
