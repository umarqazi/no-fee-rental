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
Route::post('/password-update', 'Renter\ProfileController@updatePassword')->name('renter.updatePassword');
Route::get('/password-reset', 'Renter\ProfileController@resetPassword')->name('renter.resetPassword');

// Listing Conversation Routes
Route::get('/view-conversations', 'Renter\ListingConversationController@index')->name('renter.conversations');
Route::get('/load-conversation/inbox/{id}', 'Renter\ListingConversationController@load')->name('renter.loadConversation');
Route::post('/send-message/{id}', 'Renter\ListingConversationController@reply')->name('renter.sendMessage');
Route::get('/archive-conversation/{id}', 'Renter\ListingConversationController@archive')->name('renter.archiveConversation');
Route::get('/unArchive-conversation/{id}', 'Renter\ListingConversationController@unArchive')->name('renter.unArchiveConversation');

// Calender Routes
Route::post('/add-event', 'Renter\CalendarController@create')->name('renter.addEvent');
Route::get('/show-calendar', 'Renter\CalendarController@index')->name('renter.showCalendar');

// Favourites Routes
Route::get('/favourite/listing-view', 'Renter\ListingController@wishList')->name('renter.viewListing');

// Save Search Routes
Route::get('/save-searches', 'Renter\SaveSearchController@index')->name('renter.viewSaveSearch');
Route::get('/delete-save-search/{id}', 'Renter\SaveSearchController@remove')->name('renter.removeSaveSearch');
