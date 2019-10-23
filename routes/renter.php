<?php

/*
|--------------------------------------------------------------------------
| Renter Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Routes
Route::get('/home', 'Renter\HomeController@index')->name('renter.index');

// Auth Routes
Route::get('/logout', 'Renter\AuthController@logout')->name('renter.logout');

// Profile Routes
Route::get('/show-profile', 'Renter\ProfileController@profile')->name('renter.showProfile');
Route::post('/update-profile', 'Renter\ProfileController@updateProfile')->name('renter.profileUpdate');

// Password Routes
//Route::post('/password-update', 'Renter\RenterController@updatePassword')->name('renter.updatePassword');
//Route::get('/password-reset', 'Renter\RenterController@resetPassword')->name('renter.resetPassword');
