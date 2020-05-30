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

Route::group(['middleware' => ['auth','verified']], function () {

    Route::get('/', 'LandingPageController@LandingPage')->name('landing'); 
    Route::patch('/mouse', 'LandingPageController@MouseSeen')->name('mouseSeen'); 

    // Laundries
    Route::get('/laundries', 'LaundryController@index')->name('laundries');
    Route::post('/laundries/new', 'LaundryController@insert')->name('newLaundry');
    Route::delete('/laundries/{id}/delete', 'LaundryController@delete')->name('deleteLaundry');

    // Guests
    Route::get('/guests', 'GuestController@index')->name('guests');
    Route::post('/guests/new', 'GuestController@insert')->name('newGuest');
    Route::delete('/guests/{id}/delete', 'GuestController@delete')->name('deleteGuest');
    
    // Files
    Route::get('/files', 'FileController@index')->name('files');
    Route::post('/files/new', 'FileController@store')->name('newFile');
    Route::get('/files/{uuid}/download', 'FileController@download')->name('downloadFile');
    Route::delete('/files/{uuid}/delete', 'FileController@delete')->name('deleteFile');

    // Privacy
    Route::get('/privacy', function() { return view('pages.privacy'); })->name('privacy');
    Route::delete('/user/delete', 'UserController@delete')->name('deleteuser');

    // Admin
    Route::get('/admin/dashboard', 'PageController@AdminDashboard')->name('admin');

    //Proxy
    Route::get('/admin/proxies', 'ProxyController@index')->name('proxies');
    Route::post('/admin/proxies/new', 'ProxyController@insertProxy')->name('newProxy');
    Route::patch('/admin/proxies/edit/{user_id}', 'ProxyController@editProxy')->name('editProxy');
    Route::delete('/admin/proxies/{user_id}', 'ProxyController@deleteProxy')->name('deleteProxy');
    Route::post('/admin/proxies/door/new', 'ProxyController@insertDoor')->name('newDoor');
    Route::delete('/admin/proxies/door/{door_id}', 'ProxyController@deleteDoor')->name('deleteDoor');

    Route::get('/sandbox', 'PageController@AdminSandbox');
});

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'guest'], function () {
    
    Route::get('/authprivacy', function() { return view('auth.authprivacy'); })->name('authprivacy');
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');
});
