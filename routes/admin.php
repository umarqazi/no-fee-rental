<?php

Route::get('/home', 'Admin\HomeController@index')->name('admin.index');
Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');

Route::get('/profile', 'Admin\AdminController@profile')->name('profile');
Route::post('/profile', 'UserController@editProfile')->name('edit-profile');
Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');

Route::post('/create-user', 'UserController@addUser')->name('user.add');
Route::get('/visibility/{id}', 'UserController@visibilityToggle');
Route::get('/delete-user/{id}', 'UserController@deleteUser')->name('agent.delete');