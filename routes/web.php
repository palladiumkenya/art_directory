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
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/get/messages/{id}', ['uses' => 'DirectoryController@process_incoming']);



Route::group(['middleware' => ['auth']], function () {
    Route::get('/','HomeController@index');


    Route::get('edit-profile', 'UserController@editProfile');
    Route::get('my-profile', 'UserController@myProfile');
    Route::put('edit-profile', 'UserController@updateProfile');
    Route::put('change-password', 'UserController@updatePassword');


    Route::get('/users', 'UserController@users');
    Route::post('/enroll', 'UserController@register_user');//->middleware('perm:1');
    Route::get('ajax/users', 'UserController@usersDT')->name('users-dt');



    //facilities
    Route::get('/facilities','DirectoryController@facilities');
    Route::post('/facilities','DirectoryController@add_facility');
    Route::get('ajax/facilities', 'DirectoryController@facilitiesDT')->name('ajax-facilities');
    Route::get('facilities/{facility_id}', 'DirectoryController@edit_facility')->name('edit-facility');
    Route::put('facilities', 'DirectoryController@update_facility');//->name('update-facility');
    Route::delete('facilities/{facility_id}', 'DirectoryController@delete_facility')->name('delete-facility');

    //messaging
    Route::get('/messages/incoming','MessagingController@incoming');
    Route::get('ajax/messages/incoming', 'MessagingController@incomingDT')->name('ajax-incoming-messages');

    Route::get('/messages/outgoing','MessagingController@outgoing');
    Route::get('ajax/messages/outgoing', 'MessagingController@outgoingDT')->name('ajax-outgoing-messages');





});
