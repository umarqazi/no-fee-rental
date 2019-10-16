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

// Agent Profile Routes
Route::get('/agent-profile/{agentId}', 'Agent\AgentController@profileListing')->name('web.agentProfile');

// Added User By Admin Change Password Routes
Route::get('/change-password/{token}', 'UserController@changePassword')->name('user.change_password');
Route::post('/change-password/{token}', 'UserController@updatePassword')->name('change-password');

// Forgot Password
Route::get('/reset', 'RecoverPasswordController@sendRequest');
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

// Appointment Routes
Route::post('/make-appointment', 'MakeAppointmentController@create')->name('web.makeAppointment');

// Realty MX Routes
Route::get('/realty/{file}', 'RealtyMXController@dispatchJob');
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

// Neighborhood Routes
Route::post('/all-neighborhoods', 'NeighborhoodController@all')->name('web.allNeigetghbours');
Route::get('/listing-by-neighborhood/{neighborhood}/{sort}', 'NeighborhoodController@sort');
Route::get('/listing-by-neighborhood/search', 'NeighborhoodController@advanceSearch')->name('web.advanceNeighborhoodSearch');
Route::get('/listing-by-neighborhood', 'NeighborhoodController@index')->name('web.neighborhood');
Route::match(['get', 'post'], '/listing-by-neighborhood/{neighborhood}', 'NeighborhoodController@find')->name('web.ListsByNeighborhood');

// Rent Routes
Route::get('/listing-by-rent/{sort}', 'RentController@sort');
Route::get('/listing-by-rent', 'RentController@index')->name('web.ListsByRent');
Route::get('/listing-by-rent-search', 'RentController@advanceSearch')->name('web.advanceRentSearch');

// Application Controlling Routes
Route::get('/all-clear', function() {
    artisan(['config:cache', 'view:clear', 'route:clear']);
    dd('Config Cleared, View Cleared, Routes Cleared..');
});

Route::get('/migrate-fresh-seed', function() {
    artisan(['migrate:fresh', 'db:seed']);
    dd('Migration fresh with seeding..');
});

Route::get('/composer-dump', function() {
    exec('composer dump-autoload');
    dd('composer dump-succeed');
});
