<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/home', 'Admin\HomeController@index')->name('admin.index');
Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');
Route::get('/show-profile', 'Admin\AdminController@profile')->name('admin.profile');
Route::post('/update-profile', 'Admin\AdminController@profileUpdate')->name('admin.profileUpdate');
Route::post('/password-update', 'Admin\AdminController@updatePassword')->name('admin.updatePassword');
Route::get('/password-reset', 'Admin\AdminController@resetPassword')->name('admin.resetPassword');

// User Routes
Route::get('/delete-user/{id}', 'Admin\AdminController@deleteUser')->name('admin.deleteUser');
Route::get('/status-update/{id}', 'Admin\AdminController@visibilityToggle')->name('admin.userStatus');
Route::post('/create-user', 'Admin\AdminController@addUser')->name('admin.addUser');
Route::post('/edit-user/{id}', 'Admin\AdminController@editUser')->name('admin.editUser');
Route::post('/update-user/{id}', 'Admin\AdminController@updateUser')->name('admin.updateUser');

Route::post('/profile', 'UserController@editProfile')->name('edit-profile');
Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');
Route::post('/send-invitation', 'Admin\AdminController@agentInvitations')->name('admin.sendInvitation');

// Listing Routes
Route::get('/listing-view', 'Admin\ListingController@index')->name('admin.viewListing');
Route::get('/add-listing', 'Admin\ListingController@listingForm')->name('admin.addListing');
Route::post('/add-listing', 'Admin\ListingController@addListing')->name('admin.createListing');
Route::get('/approve-listing-request/{id}', 'Admin\ListingController@approveRequest')->name('admin.approveRequest');
Route::get('/listing-status/{id}', 'Admin\ListingController@listingVisibilityToggle')->name('admin.listingStatus');
Route::post('/upload-listing-images/{id}', 'Admin\ListingController@uploadImages')->name('admin.listingImages');
Route::get('/remove-listing-image/{id}', 'Admin\ListingController@removeListingImage');
Route::get('/listing-repost/{id}', 'Admin\ListingController@repostListing')->name('admin.listingRepost');
Route::match(['get', 'post'], '/search-listing', 'Admin\ListingController@searchListingWithFilters')->name('admin.listingSearch');
Route::get('/edit-list/{id}', 'Admin\ListingController@editListingForm')->name('admin.editListing');
Route::post('/update-listing/{id}', 'Admin\ListingController@updateListing')->name('admin.updateListing');
Route::get('/finish-create-listing', 'Admin\ListingController@finishCreate')->name('admin.finishCreateListing');
Route::get('/finish-update-listing', 'Admin\ListingController@finishUpdate')->name('admin.finishUpdateListing');

// Featured Listing Routes
Route::get('/feature-listing', 'Admin\FeaturedListingController@index')->name('admin.featureListing');
Route::get('/approve-feature-request/{id}', 'Admin\FeaturedListingController@approveFeatureRequest')->name('admin.approveFeature');
Route::get('/remove-featured-listing/{id}', 'Admin\FeaturedListingController@removeFeatured')->name('admin.removeFeatured');
