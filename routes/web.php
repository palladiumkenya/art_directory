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


    Route::get('/users', 'UserController@users')->middleware('perm:1');
    Route::post('/enroll', 'UserController@register_user')->middleware('perm:1');
    Route::get('ajax/users', 'UserController@usersDT')->name('users-dt')->middleware('perm:1');


    Route::get('/user_groups', 'UserController@user_groups')->middleware('perm:1');
    Route::post('/user_groups', 'UserController@new_user_group')->middleware('perm:1');
    Route::get('user_groups/{_id}', 'UserController@get_group_details')->middleware('perm:1');
    Route::post('user_groups/update', 'UserController@update_group_details')->middleware('perm:1');
    Route::post('user_groups/delete', 'UserController@delete_group')->middleware('perm:1');

    Route::get('ajax/users/groups/details/{id}', 'UserController@userGroupDetailsDT')->middleware('perm:1');
    Route::get('users/groups/{id}','UserController@user_group_details')->middleware('perm:1');
    Route::post('/users/groups/permissions/add','UserController@add_group_permission')->middleware('perm:1');
    Route::get('/users/groups/permissions/delete/{id}','UserController@delete_group_permission')->middleware('perm:1');






    //facilities
    Route::get('/facilities','DirectoryController@facilities');
    Route::post('/facilities','DirectoryController@add_facility')->middleware('perm:6');
    Route::get('ajax/facilities', 'DirectoryController@facilitiesDT')->name('ajax-facilities');
    Route::get('facilities/{facility_id}', 'DirectoryController@edit_facility')->name('edit-facility');
    Route::put('facilities', 'DirectoryController@update_facility');//->name('update-facility');
    Route::delete('facilities/{facility_id}', 'DirectoryController@delete_facility')->name('delete-facility');

    //county sub counties
    Route::get('sub_counties/{county_id}', 'HomeController@sub_counties');

    //messaging
    Route::get('/messages/incoming','MessagingController@incoming')->middleware('perm:2');
    Route::get('ajax/messages/incoming', 'MessagingController@incomingDT')->name('ajax-incoming-messages')->middleware('perm:2');

    Route::get('/messages/outgoing','MessagingController@outgoing')->middleware('perm:3');
    Route::get('ajax/messages/outgoing', 'MessagingController@outgoingDT')->name('ajax-outgoing-messages')->middleware('perm:3');





});
