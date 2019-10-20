<?php

/*
|--------------------------------------------------------------------------
| Owner Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Routes
Route::get('/home', 'Owner\ListingController@index')->name('owner.index');

// Auth Routes
Route::get('/logout', 'Owner\AuthController@logout')->name('owner.logout');

// Profile Routes
Route::get('/listing-profile', 'Owner\ListingController@profile');
Route::get('/show-profile', 'Owner\OwnerController@profile')->name('owner.showProfile');
Route::post('/update-profile', 'Owner\OwnerController@updateProfile')->name('owner.profileUpdate');

// Password Routes
Route::post('/password-update', 'Owner\OwnerController@updatePassword')->name('owner.updatePassword');
Route::get('/password-reset', 'Owner\OwnerController@resetPassword')->name('owner.resetPassword');

// Listing Routes
Route::get('/add-listing-images/{id}', 'Owner\ListingController@createImages')->name('owner.createListingImages');
Route::post('/add-listing', 'Owner\ListingController@create')->name('owner.createListing');
Route::get('/add-listing', 'Owner\ListingController@showForm')->name('owner.addListing');
Route::post('/upload-listing-images/{id}', 'Owner\ListingController@uploadImages')->name('owner.listingImages');
Route::get('/remove-listing-image/{id}', 'Owner\ListingController@removeImage');
Route::get('/listing-repost/{id}', 'Owner\ListingController@repost')->name('owner.repostListing');
Route::match(['get', 'post'], '/search-listing', 'Owner\ListingController@searchWithFilters')->name('owner.listingSearch');
Route::get('/listing-status/{id}', 'Owner\ListingController@status')->name('owner.listingStatus');
Route::get('/edit-list/{id}', 'Owner\ListingController@edit')->name('owner.editListing');
Route::post('/update-listing/{id}', 'Owner\ListingController@update')->name('owner.updateListing');
Route::get('/finish-listing', 'Owner\ListingController@finishCreate')->name('owner.finishCreateListing');
Route::get('/update-listing', 'Owner\ListingController@finishUpdate')->name('owner.finishUpdateListing');
Route::get('/listing/{sortBy}', 'Owner\ListingController@sortBy')->name('owner.sorting');
Route::get('/copy-list/{id}', 'Owner\ListingController@copy')->name('owner.copyListing');

// Featured Listing
Route::get('/request-featured/{id}', 'Owner\ListingController@requestFeatured')->name('owner.requestFeatured');

// Owner Members Routes
Route::get('/team', 'Owner\MemberController@index')->name('owner.team');
Route::get('/all-invites', 'Owner\MemberController@get')->name('owner.getInvites');
Route::post('/invite-owner', 'Owner\MemberController@invite')->name('owner.inviteMember');
Route::get('/accept-invitation/{token}', 'Owner\MemberController@acceptInvitation')->name('owner.acceptInvitation');
Route::get('/un-friend/{id}', 'Owner\MemberController@unFriend')->name('owner.unFriend');

// Messaging Routes
/*Route::post('/accept-meeting/{id}', 'Owner\MessageController@accept');
Route::get('/view-contacts', 'Owner\MessageController@index')->name('owner.messageIndex');
Route::get('/load-chat/inbox/{id}', 'Owner\MessageController@loadInbox')->name('owner.loadAppointmentChat');
Route::get('/load-chat/availabilities/{id}', 'Owner\MessageController@loadAvailability')->name('owner.loadAvailabilityChat');
Route::post('/send-message/inbox/{id}', 'Owner\MessageController@replyInbox')->name('owner.sendInboxMessage');
Route::post('/send-message/availability/{id}', 'Owner\MessageController@replyAvailability')->name('owner.sendAvailabilityMessage');
Route::get('/archive-inbox-chat/{id}', 'Owner\MessageController@archiveInbox')->name('owner.archiveAppointmentChat');
Route::get('/archive-availability-chat/{id}', 'Owner\MessageController@archiveAvailability')->name('owner.archiveAvailabilityChat');*/

Route::post('/accept-meeting/{id}', 'Owner\MessageController@accept');
Route::get('/view-conversations', 'Owner\MessageController@index')->name('owner.conversations');
Route::get('/load-conversation/inbox/{id}', 'Owner\MessageController@load')->name('owner.loadConversation');
Route::post('/send-message/{id}', 'Owner\MessageController@reply')->name('owner.sendMessage');
Route::get('/archive-conversation/{id}', 'Owner\MessageController@archive')->name('owner.archiveConversation');
Route::get('/unArchive-conversation/{id}', 'Owner\MessageController@unArchive')->name('owner.unArchiveConversation');


// Calender Routes
Route::post('/add-event', 'Owner\CalendarController@create')->name('owner.addEvent');
Route::get('/show-calendar', 'Owner\CalendarController@index')->name('owner.showCalendar');
