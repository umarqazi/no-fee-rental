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

// Auth Route
Route::get('/logout', 'Renter\AuthController@logout')->name('renter.logout');

// Profile Routes
Route::get('/show-profile', 'Renter\ProfileController@profile')->name('renter.showProfile');
Route::post('/update-profile', 'Renter\ProfileController@updateProfile')->name('renter.profileUpdate');

// Password Routes
Route::post('/password-update', 'Renter\ProfileController@updatePassword')->name('renter.updatePassword');
Route::get('/password-reset', 'Renter\ProfileController@resetPassword')->name('renter.resetPassword');

// Listing Conversation Routes
Route::get('/view-conversations', 'Renter\ConversationController@index')->name('renter.conversations');
Route::get('/load-conversation/inbox/{id}', 'Renter\ConversationController@load')->name('renter.loadConversation');
Route::post('/send-message/{id}', 'Renter\ConversationController@reply')->name('renter.sendMessage');
Route::get('/archive-conversation/{id}', 'Renter\ConversationController@archive')->name('renter.archiveConversation');
Route::get('/unArchive-conversation/{id}', 'Renter\ConversationController@unArchive')->name('renter.unArchiveConversation');

// Calender Routes
Route::post('/add-event', 'Renter\CalendarController@create')->name('renter.addEvent');
Route::get('/show-calendar', 'Renter\CalendarController@index')->name('renter.showCalendar');

// Favourites Routes
Route::get('/favourite-listings', 'Renter\ListingController@wishList')->name('renter.index');

// Save Search Routes
Route::get('/save-searches', 'Renter\SaveSearchController@index')->name('renter.viewSaveSearch');
Route::get('/delete-save-search/{id}', 'Renter\SaveSearchController@remove')->name('renter.removeSaveSearch');
