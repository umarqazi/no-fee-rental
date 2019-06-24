<?php

Route::get('/home', 'Admin\HomeController@index')->name('admin.index');
Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
Route::get('/show-profile', 'Admin\AdminController@profile')->name('admin.profile');
Route::get('/password-reset', 'Admin\AdminController@resetPassword')->name('admin.resetPassword');
Route::post('/create-user', 'Admin\AdminController@addUser')->name('admin.addUser');
Route::post('/update-profile', 'Admin\AdminController@profileUpdate')->name('admin.profileUpdate');
Route::post('/password-update', 'Admin\AdminController@updatePassword')->name('admin.updatePassword');

Route::post('/profile', 'UserController@editProfile')->name('edit-profile');
Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');

Route::get('/visibility/{id}', 'UserController@visibilityToggle');
Route::get('/delete-user/{id}', 'UserController@deleteUser')->name('agent.delete');