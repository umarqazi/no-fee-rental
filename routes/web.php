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
use Illuminate\Support\Facades\Redis;

Route::get('/', 'HomeController@index')->name('web.index');

Route::get('/search', 'SearchController@advanceSearch')->name('list.search');

Route::get('/renter-guide', function () {
	return view('pages.renter-guide');
});

// Contact Us Routes
Route::get('/contact-us', 'ContactUsController@showForm')->name('contact-us');
Route::post('/contact-us', 'ContactUsController@contactUs')->name('contact-us');

// Wordpress Pages
Route::get('/press', 'ContactUsController@showPress')->name('press');
Route::post('newsletter', 'NewsletterController@store');

// Added User By Admin Change Password Routes
Route::get('/change-password/{token}', 'UserController@changePassword')->name('user.change_password');
Route::post('/change-password/{token}', 'UserController@updatePassword')->name('change-password');

// Email Confirmation
Route::get('/confirm-email/{token}', 'UserController@confirmEmail')->name('user.confirmEmail');

// Login route for all user type
Route::post('/login')->name('attempt.login')->middleware('authguard');

// Route for Invited Agent Signup
Route::get('/signup/{token}', 'UserController@invitedAgentSignupForm')->name('agent.signup_form');

Route::post('/user-signup', 'UserController@signup')->name('user.signup');
Route::post('/agent/signup', 'UserController@invitedAgentSignup')->name('agent.signup');
Route::get('/listing-detail/{id}', 'HomeController@detail')->name('listing.detail');

// Messaging Routes
Route::post('/send-message', 'MessageController@send')->name('send.message');

// Realty MX Routes
Route::get('/test/{file}', 'RealtyMXController@get');
Route::get('/realty-mx/{client}/{listing}', function($a, $b) {
    dd(\App\Listing::where('realty_id', $b)->first());
});

Route::post('/listing-detail', 'ListingController@detail');
