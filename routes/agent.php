<?php

/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Routes
Route::get('/home', 'Agent\ListingController@index')->name('agent.index');

// Auth Routes
Route::get('/logout', 'Agent\AuthController@logout')->name('agent.logout');

// Profile Routes
Route::get('/listing-profile', 'Agent\ListingController@profile');
Route::get('/show-profile', 'Agent\AgentController@profile')->name('agent.showProfile');
Route::post('/update-profile', 'Agent\AgentController@updateProfile')->name('agent.profileUpdate');

// Password Routes
Route::post('/password-update', 'Agent\AgentController@updatePassword')->name('agent.updatePassword');
Route::get('/password-reset', 'Agent\AgentController@resetPassword')->name('agent.resetPassword');

// Listing Routes
Route::get('/add-listing-images/{id}', 'Agent\ListingController@createImages')->name('agent.createListingImages');
Route::post('/add-listing', 'Agent\ListingController@create')->name('agent.createListing');
Route::get('/add-listing', 'Agent\ListingController@showForm')->name('agent.addListing');
Route::post('/upload-listing-images/{id}', 'Agent\ListingController@uploadImages')->name('agent.listingImages');
Route::get('/remove-listing-image/{id}', 'Agent\ListingController@removeImage');
Route::get('/listing-repost/{id}', 'Agent\ListingController@repost')->name('agent.repostListing');
Route::match(['get', 'post'], '/search-listing', 'Agent\ListingController@searchWithFilters')->name('agent.listingSearch');
Route::get('/listing-status/{id}', 'Agent\ListingController@status')->name('agent.listingStatus');
Route::get('/edit-list/{id}', 'Agent\ListingController@edit')->name('agent.editListing');
Route::post('/update-listing/{id}', 'Agent\ListingController@update')->name('agent.updateListing');
Route::get('/finish-listing', 'Agent\ListingController@finishCreate')->name('agent.finishCreateListing');
Route::get('/update-listing', 'Agent\ListingController@finishUpdate')->name('agent.finishUpdateListing');
Route::get('/listing/{sortBy}', 'Agent\ListingController@sortBy')->name('agent.sorting');
Route::get('/copy-list/{id}', 'Agent\ListingController@copy')->name('agent.copyListing');

// Featured Listing
Route::get('/request-featured/{id}', 'Agent\ListingController@requestFeatured')->name('agent.requestFeatured');

// Agent Members Routes
Route::get('/team', 'Agent\MemberController@index')->name('agent.team');
Route::get('/all-invites', 'Agent\MemberController@get')->name('agent.getInvites');
Route::post('/invite-agent', 'Agent\MemberController@invite')->name('agent.inviteMember');
Route::get('/accept-invitation/{token}', 'Agent\MemberController@acceptInvitation')->name('agent.acceptInvitation');
Route::get('/un-friend/{id}', 'Agent\MemberController@unFriend')->name('agent.unFriend');

// Listing Conversation Routes
Route::post('/accept-meeting/{id}', 'Agent\ListingConversationController@accept');
Route::get('/view-conversations', 'Agent\ListingConversationController@index')->name('agent.conversations');
Route::get('/load-conversation/inbox/{id}', 'Agent\ListingConversationController@load')->name('agent.loadConversation');
Route::post('/send-message/{id}', 'Agent\ListingConversationController@reply')->name('agent.sendMessage');
Route::get('/archive-conversation/{id}', 'Agent\ListingConversationController@archive')->name('agent.archiveConversation');
Route::get('/unArchive-conversation/{id}', 'Agent\ListingConversationController@unArchive')->name('agent.unArchiveConversation');

// Calender Routes
Route::post('/add-event', 'Agent\CalendarController@create')->name('agent.addEvent');
Route::get('/show-calendar', 'Agent\CalendarController@index')->name('agent.showCalendar');

//reviews
Route::get('/reviews' , 'Agent\AgentController@reviews')->name('agent.reviews');
