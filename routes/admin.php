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
// Index Routes
Route::get('/home', 'Admin\HomeController@index')->name('admin.index');

// Auth Routes
Route::get('/logout', 'Admin\AuthController@logout')->name('admin.logout');

// Profile Routes
Route::get('/show-profile', 'Admin\AdminController@showProfile')->name('admin.showProfile');
Route::post('/update-profile', 'Admin\AdminController@updateProfile')->name('admin.updateProfile');

// ResetPassword Routes
Route::get('/password-reset', 'Admin\AdminController@resetPassword')->name('admin.resetPassword');
Route::post('/password-update', 'Admin\AdminController@updatePassword')->name('admin.updatePassword');

// User Routes
Route::post('/delete-user/{id}', 'Admin\UserController@delete')->name('admin.deleteUser');
Route::post('/status-update/{id}', 'Admin\UserController@status')->name('admin.statusUser');
Route::post('/create-user', 'Admin\UserController@create')->name('admin.createUser');
Route::post('/edit-user/{id}', 'Admin\UserController@edit')->name('admin.editUser');
Route::post('/update-user/{id}', 'Admin\UserController@update')->name('admin.updateUser');
Route::post('/search-user', 'Admin\UserController@search')->name('admin.searchUser');
Route::post('/send-invitation', 'Admin\UserController@invite')->name('admin.sendInvitation');

// Listing Routes
Route::get('/add-listing-images/{id}', 'Admin\ListingController@createImages')->name('admin.createListingImages');
Route::post('/add-listing', 'Admin\ListingController@create')->name('admin.createListing');
Route::match(['get', 'post'], '/search-listing', 'Admin\ListingController@searchWithFilters')->name('admin.listingSearch');
Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');
Route::get('/listing-view', 'Admin\ListingController@index')->name('admin.viewListing');
Route::get('/add-listing', 'Admin\ListingController@showForm')->name('admin.addListing');
Route::get('/approve-listing-request/{id}', 'Admin\ListingController@approve')->name('admin.approveRequest');
Route::get('/listing-status/{id}', 'Admin\ListingController@status')->name('admin.listingStatus');
Route::post('/upload-listing-images/{id}', 'Admin\ListingController@uploadImages')->name('admin.listingImages');
Route::get('/remove-listing-image/{id}', 'Admin\ListingController@removeImage');
Route::get('/listing-repost/{id}', 'Admin\ListingController@repost')->name('admin.repostListing');
Route::get('/edit-list/{id}', 'Admin\ListingController@edit')->name('admin.editListing');
Route::get('/copy-list/{id}', 'Admin\ListingController@copy')->name('admin.copyListing');
Route::post('/update-listing/{id}', 'Admin\ListingController@update')->name('admin.updateListing');
Route::get('/finish-create-listing', 'Admin\ListingController@finishCreate')->name('admin.finishCreateListing');
Route::get('/finish-update-listing', 'Admin\ListingController@finishUpdate')->name('admin.finishUpdateListing');
Route::get('/listing/{sortBy}', 'Admin\ListingController@sortBy')->name('admin.sorting');

// Featured Listing Routes
Route::get('/feature-listing/{sortBy}', 'Admin\FeaturedListingController@sortBy')->name('admin.featureSorting');
Route::match(['get', 'post'], '/search-feature-listing', 'Admin\FeaturedListingController@searchWithFilters')->name('admin.featureListingSearch');
Route::get('/feature-listing', 'Admin\FeaturedListingController@index')->name('admin.featureListing');
Route::get('/approve-feature-request/{id}', 'Admin\FeaturedListingController@approve')->name('admin.approveFeature');
Route::get('/remove-featured-listing/{id}', 'Admin\FeaturedListingController@remove')->name('admin.removeFeatured');

// Jquery Email Validation Response
Route::post('/unique-email', 'Admin\UserController@unique');

Route::get('/get-renters', 'Admin\HomeController@renters');
Route::get('/get-agents', 'Admin\HomeController@agents');
Route::get('/get-companies', 'Admin\HomeController@companies');

// Company Routes
Route::post('/add-company', 'Admin\CompanyController@create')->name('admin.createCompany');
Route::post('/edit-company/{id}', 'Admin\CompanyController@edit');
Route::post('/update-company/{id}', 'Admin\CompanyController@update');
Route::post('/delete-company/{id}', 'Admin\CompanyController@delete');
Route::post('/company-status-update/{id}', 'Admin\CompanyController@status');
