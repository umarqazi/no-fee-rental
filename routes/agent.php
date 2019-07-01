<?php

Route::get('/home', 'Agent\ListingController@index')->name('agent.index');
Route::get('/logout', 'Agent\LoginController@logout')->name('agent.logout');

Route::get('/show-profile', 'Agent\AgentController@profile')->name('agent.profile');
Route::post('/update-profile', 'Agent\AgentController@profileUpdate')->name('agent.profileUpdate');

Route::post('/password-update', 'Agent\AgentController@updatePassword')->name('agent.updatePassword');
Route::get('/password-reset', 'Agent\AgentController@resetPassword')->name('agent.resetPassword');

Route::get('/add-listing', 'Agent\ListingController@listingForm')->name('agent.addListing');

Route::get('/upload-listing-images/{id}', 'Agent\ListingController@showListingImagesForm')->name('agent.listingImagesForm');
Route::post('/upload-listing-images/{id}', 'Agent\ListingController@uploadImages')->name('agent.listingImages');
Route::post('/add-listing', 'Agent\ListingController@addListing')->name('agent.createListing');
Route::get('/listing-repost/{id}', 'Agent\ListingController@repostListing')->name('agent.listingRepost');
Route::match(['get', 'post'], '/search-listing', 'Agent\ListingController@searchListingWithFilters')->name('agent.listingSearch');
Route::get('/listing-status/{id}', 'Agent\ListingController@listingVisibilityToggle')->name('agent.listingStatus');
Route::get('/edit-list/{id}', 'Agent\ListingController@editListingForm')->name('agent.editListing');
Route::post('/update-listing/{id}', 'Agent\ListingController@updateListing')->name('agent.updateListing');