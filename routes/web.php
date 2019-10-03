<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'HomeController@index')->name('web.index');

// Search Listing Route
Route::get('/search', 'SearchController@advanceSearch')->name('list.search');

// Contact Us Routes
Route::get('/contact-us', 'ContactUsController@showForm')->name('contact-us');
Route::post('/contact-us', 'ContactUsController@contactUs')->name('contact-us');

// subscription through mail chimp
Route::post('/newsletter-subscribe', 'NewsletterController@subscribe')->name('newsLetter-subscription');

// Wordpress Pages
Route::get('/press', 'ContactUsController@showPress')->name('press');
Route::post('newsletter', 'NewsletterController@store');

// Added User By Admin Change Password Routes
Route::get('/change-password/{token}', 'UserController@changePassword')->name('user.change_password');
Route::post('/change-password/{token}', 'UserController@updatePassword')->name('change-password');

// Forgot Password
Route::get('/forgot-password', 'RecoverPasswordController@resetForm')->name('forgot.password');
Route::post('/reset-password', 'RecoverPasswordController@sendRequest')->name('password.email');
Route::post('/update-password', 'RecoverPasswordController@recover')->name('password.update');
Route::get('/reset-password/{token}', 'RecoverPasswordController@recoverForm')->name('recover.password');

// Email Confirmation
Route::get('/confirm-email/{token}', 'UserController@confirmEmail')->name('user.confirmEmail');

// Email Validation
Route::post('/verify-email', 'UserController@verifyEmail');

// License Validations
Route::post('/verify-license', 'UserController@verifyLicense');

// Login route for all user type
Route::post('/login')->name('attempt.login')->middleware('authguard');

// Route for Invited Agent Signup
Route::get('/signup/{token}', 'UserController@invitedAgentSignupForm')->name('agent.signup_form');

// User Signup Routes
Route::post('/user-signup', 'UserController@signup')->name('user.signup');
Route::post('/agent/signup', 'UserController@invitedAgentSignup')->name('agent.signup');

// Messaging Routes
Route::post('/send-message', 'MessageController@send')->name('send.message');

// Realty MX Routes
Route::get('/test/{file}', 'RealtyMXController@get');
Route::get('/realty-mx/{client}/{listing}', 'RealtyMXController@detail')->name('web.realty');

// Listing Routes
Route::post('/listing-detail', 'ListingController@detail');
Route::get('/listing-detail/{id}', 'HomeController@detail')->name('listing.detail');

// Notification Routes
Route::post('/delete-notification/{id}', 'NotificationController@delete');
Route::post('/mark-all-as-read', 'NotificationController@markAsRead');
Route::post('/push-notification', 'NotificationController@push');
Route::post('/fetch-notifications', 'NotificationController@get');
Route::get('/all-notifications', 'NotificationController@all');


Route::get('/noti', function() {
	return view('secured-layouts.notifications');
});

Route::get('/rent', function() {
    return view('rent');
});

Route::get('/reset', 'RecoverPasswordController@sendRequest');

// Neighborhood Routes
Route::get('/neighborhood', 'NeighborhoodController@index')->name('web.neighborhood');
Route::get('/neighborhood-listing', 'NeighborhoodController@find')->name('web.findNeighborhoodLists');
Route::post('/all-neighborhoods', 'NeighborhoodController@all')->name('web.allNeighbours');
