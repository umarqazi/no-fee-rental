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

// Home Routes
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
Route::prefix('listing')->group(function() {
    Route::get('/add-images/{id}', 'Admin\ListingController@createImages')->name('admin.createListingImages');
    Route::post('/add-listing', 'Admin\ListingController@create')->name('admin.createListing');
    Route::match(['get', 'post'], '/search', 'Admin\ListingController@searchWithFilters')->name('admin.listingSearch');
    Route::get('/property', 'Admin\AdminController@viewPropertyListing')->name('property-listing');
    Route::get('/view', 'Admin\ListingController@index')->name('admin.viewListing');
    Route::get('/add', 'Admin\ListingController@showForm')->name('admin.addListing');
    Route::get('/approve-request/{id}', 'Admin\ListingController@approve')->name('admin.approveRequest');
    Route::get('/status/{id}', 'Admin\ListingController@status')->name('admin.listingStatus');
    Route::post('/upload-images/{id}', 'Admin\ListingController@uploadImages')->name('admin.listingImages');
    Route::get('/remove-image/{id}', 'Admin\ListingController@removeImage');
    Route::get('/repost/{id}', 'Admin\ListingController@repost')->name('admin.repostListing');
    Route::get('/edit/{id}', 'Admin\ListingController@edit')->name('admin.editListing');
    Route::get('/copy/{id}', 'Admin\ListingController@copy')->name('admin.copyListing');
    Route::post('/update/{id}', 'Admin\ListingController@update')->name('admin.updateListing');
    Route::get('/finish-create', 'Admin\ListingController@finishCreate')->name('admin.finishCreateListing');
    Route::get('/finish-update', 'Admin\ListingController@finishUpdate')->name('admin.finishUpdateListing');
    Route::get('/{sortBy}', 'Admin\ListingController@sortBy')->name('admin.sorting');
});

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
Route::get('/get-owners', 'Admin\HomeController@owners');
Route::get('/get-companies-with-agents', 'Admin\HomeController@companies');

// Company Routes
Route::post('/add-company', 'Admin\CompanyController@create')->name('admin.createCompany');
Route::post('/edit-company/{id}', 'Admin\CompanyController@edit');
Route::post('/update-company/{id}', 'Admin\CompanyController@update');
Route::post('/delete-company/{id}', 'Admin\CompanyController@delete');
Route::post('/company-status-update/{id}', 'Admin\CompanyController@status');
Route::get('/view-associated-agents/{id}', 'Admin\HomeController@associatedAgents');

// Neighborhood Routes
Route::get('/neighborhoods', 'Admin\NeighborhoodController@index')->name('admin.neighborhood');
Route::get('/manhattan-neighborhoods', 'Admin\NeighborhoodController@manhattan');
Route::get('/bronx-neighborhoods', 'Admin\NeighborhoodController@bronx');
Route::get('/brooklyn-neighborhoods', 'Admin\NeighborhoodController@brooklyn');
Route::get('/queens-neighborhoods', 'Admin\NeighborhoodController@queens');
Route::get('/staten_island-neighborhoods', 'Admin\NeighborhoodController@statenIsland');
Route::get('/other-neighborhoods', 'Admin\NeighborhoodController@other');
Route::post('/create-neighborhood', 'Admin\NeighborhoodController@create')->name('admin.createNeighborhood');
Route::post('/neighborhood/edit/{id}', 'Admin\NeighborhoodController@edit')->name('neighborhood.edit');
Route::post('/neighborhood/update/{id}', 'Admin\NeighborhoodController@update')->name('neighborhood.update');
Route::post('/neighborhood/delete/{id}', 'Admin\NeighborhoodController@delete')->name('neighborhood.delete');

// Manage Building Routes
Route::get('/all-buildings', 'Admin\BuildingController@index')->name('admin.manageBuildingIndex');
Route::post('/verify-building/{id}', 'Admin\BuildingController@verify')->name('admin.verifyBuilding');
Route::get('/verifying-building/{id}', 'Admin\BuildingController@verifying')->name('admin.buildingDetails');
Route::get('/edit-building/{id}', 'Admin\BuildingController@edit')->name('admin.editBuilding');
Route::post('/update-building/{id}', 'Admin\BuildingController@update')->name('admin.updateBuilding');
Route::get('/no-fee-building/{id}', 'Admin\BuildingController@noFee')->name('admin.noFeeBuilding');
Route::get('/fee-building/{id}', 'Admin\BuildingController@fee')->name('admin.feeBuilding');
Route::get('/add-apartment/{id}', 'Admin\BuildingController@addApartment')->name('admin.addApartment');

// Listing Reports
Route::get('/all-reports', 'Admin\ListingReports@get')->name('admin.listingReportIndex');
Route::get('/view-report/{id}', 'Admin\ListingReports@detail')->name('admin.listingReportDetail');
Route::post('/remove-report/{id}', 'Admin\ListingReports@delete')->name('admin.listingReportRemove');
Route::post('/response-report/{id}', 'Admin\ListingReports@reply')->name('admin.listingReportReply');
