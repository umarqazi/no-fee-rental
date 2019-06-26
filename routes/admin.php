<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/home', 'Admin\HomeController@index')->name('admin.index');
Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
Route::get('/show-profile', 'Admin\AdminController@profile')->name('admin.profile');
Route::get('/password-reset', 'Admin\AdminController@resetPassword')->name('admin.resetPassword');
Route::get('/delete-user/{id}', 'Admin\AdminController@deleteUser')->name('admin.deleteUser');
Route::get('/status-update/{id}', 'Admin\AdminController@visibilityToggle')->name('admin.userStatus');
Route::post('/create-user', 'Admin\AdminController@addUser')->name('admin.addUser');
Route::post('/update-profile', 'Admin\AdminController@profileUpdate')->name('admin.profileUpdate');
Route::post('/password-update', 'Admin\AdminController@updatePassword')->name('admin.updatePassword');

Route::post('/profile', 'UserController@editProfile')->name('edit-profile');
Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');

Route::post('/send-invitation', 'Admin\AdminController@agentInvitations')->name('admin.sendInvitation');