<?php

// Home Routes
Route::get('/home', 'Agent\ListingController@index')->name('agent.index');

// Auth Routes
Route::get('/logout', 'Agent\LoginController@logout')->name('agent.logout');

// Profile Routes
Route::get('/show-profile', 'Agent\AgentController@profile')->name('agent.profile');
Route::post('/update-profile', 'Agent\AgentController@updateProfile')->name('agent.profileUpdate');

// Password Routes
Route::post('/password-update', 'Agent\AgentController@updatePassword')->name('agent.updatePassword');
Route::get('/password-reset', 'Agent\AgentController@resetPassword')->name('agent.resetPassword');

// Listing Routes
Route::post('/add-listing', 'Agent\ListingController@create')->name('agent.createListing');
Route::get('/add-listing', 'Agent\ListingController@showForm')->name('agent.addListing');
Route::post('/upload-listing-images/{id}', 'Agent\ListingController@uploadImages')->name('agent.listingImages');
Route::post('/remove-listing-image/{id}', 'Agent\ListingController@removeImage');
Route::get('/listing-repost/{id}', 'Agent\ListingController@repost')->name('agent.listingRepost');
Route::match(['get', 'post'], '/search-listing', 'Agent\ListingController@searchWithFilters')->name('agent.listingSearch');
Route::get('/listing-status/{id}', 'Agent\ListingController@status')->name('agent.listingStatus');
Route::get('/edit-list/{id}', 'Agent\ListingController@edit')->name('agent.editListing');
Route::post('/update-listing/{id}', 'Agent\ListingController@update')->name('agent.updateListing');
Route::get('/finish-listing', 'Agent\ListingController@finishCreate')->name('agent.finishCreateListing');
Route::get('/update-listing', 'Agent\ListingController@finishUpdate')->name('agent.finishUpdateListing');

// Featured Listing
Route::get('/request-featured/{id}', 'Agent\ListingController@request')->name('agent.requestFeatured');