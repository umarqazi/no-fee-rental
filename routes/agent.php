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

// Listing Routes Protected
Route::middleware('agentHasPlan')->group(function () {
    Route::get('/add-listing-images/{id}', 'Agent\ListingController@createImages')->name('agent.createListingImages');
    Route::post('/add-listing', 'Agent\ListingController@create')->name('agent.createListing');
    Route::get('/add-listing', 'Agent\ListingController@showForm')->name('agent.addListing');
    Route::get('/listing-repost/{id}', 'Agent\ListingController@repost')->name('agent.repostListing');
    Route::get('/unarchive-listing/{id}', 'Agent\ListingController@unArchive')->name('agent.unArchive');
    Route::get('/archive-listing/{id}', 'Agent\ListingController@archive')->name('agent.archive');
    Route::get('/finish-listing', 'Agent\ListingController@finishCreate')->name('agent.finishCreateListing');
    Route::get('/copy-list/{id}', 'Agent\ListingController@copy')->name('agent.copyListing');
    Route::get('/copying-list/{id}', 'Agent\ListingController@copy')->name('agent.approveRequest');
    // Featured Listing
    Route::get('/request-featured/{id}', 'Agent\ListingController@requestFeatured')->name('agent.requestFeatured');
});

// Listing Routes
Route::get('/listing/{sortBy}', 'Agent\ListingController@sortBy')->name('agent.sorting');
Route::get('/update-listing', 'Agent\ListingController@finishUpdate')->name('agent.finishUpdateListing');
Route::post('/update-listing/{id}', 'Agent\ListingController@update')->name('agent.updateListing');
Route::get('/edit-list/{id}', 'Agent\ListingController@edit')->name('agent.editListing');
Route::match(['get', 'post'], '/search-listing', 'Agent\ListingController@searchWithFilters')->name('agent.listingSearch');
Route::get('/remove-listing-image/{id}', 'Agent\ListingController@removeImage');
Route::post('/upload-listing-images/{id}', 'Agent\ListingController@uploadImages')->name('agent.listingImages');
Route::get('/make-featured/{id}', 'Agent\ListingController@approve')->name('agent.makeFeature');


// Agent Members Routes
Route::get('/team', 'Agent\MemberController@index')->name('agent.team');
Route::get('/all-invites', 'Agent\MemberController@get')->name('agent.getInvites');
Route::post('/invite-agent', 'Agent\MemberController@invite')->name('agent.inviteMember');
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

// Reviews Routes
Route::get('/all-reviews' , 'Agent\ReviewController@index')->name('agent.viewReviews');
Route::post('/send-review-request' , 'Agent\ReviewController@request')->name('agent.requestReview');
Route::get('/reviews' , 'Agent\AgentController@reviews')->name('agent.reviews');

// Credit Plan Routes
Route::get('/credit-plan', 'Agent\CreditPlanController@index')->name('agent.creditPlan');
Route::get('/show-plan', 'Agent\CreditPlanController@subscription')->name('agent.plan');
Route::post('/change-card', 'Agent\CreditPlanController@changeCard')->name('agent.changeCard');
Route::post('/purchase-plan', 'Agent\CreditPlanController@create')->name('agent.purchasePlan');

Route::get('/basic-plan', function() {
    return view('agent.credit_plan');
})->name('agent.basicPlan');
