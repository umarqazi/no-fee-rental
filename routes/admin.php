<?php

Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin-dashboard');
Route::get('/profile', 'Admin\AdminController@profile')->name('profile');
Route::post('/profile', 'UserController@editProfile')->name('edit-profile');
Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');

Route::post('/create-user', 'UserController@addUser')->name('user.add');
Route::get('/visibility/{id}', 'UserController@visibilityToggle');
Route::get('/delete-user/{id}', 'UserController@deleteUser')->name('user.delete');