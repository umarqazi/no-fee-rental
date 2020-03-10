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

Route::post('/stripe-checkout', function(\Illuminate\Http\Request $request) { return print_r($request->all()); });

Route::get('/', 'HomeController@index')->name('web.index');

// Search Listing Routes
Route::post('/search', 'SearchController@pagination');
Route::get('/search', 'SearchController@search')->name('web.search');

// Rent Routes
Route::post('/listings-by-rent', 'RentController@pagination');
Route::get('/listings-by-rent', 'RentController@index')->name('web.listsByRent');

// Neighborhood Routes
Route::post('/all-neighborhoods', 'NeighborhoodController@all');
Route::post('/listings-by-neighborhood', 'NeighborhoodController@pagination');
Route::get('/listings-by-neighborhood', 'NeighborhoodController@index')->name('web.listsByNeighborhood');

// Profile Routes
Route::post('/profile/{id}', 'ProfileController@pagination');
Route::get('/profile/{id}', 'ProfileController@index')->name('web.agentProfile');

// Contact Us Routes
Route::get('/contact-us', 'ContactUsController@index')->name('web.contactUs');
Route::post('/contact-us', 'ContactUsController@sendRequest')->name('web.sendRequest');

// Mailchimp Subscription Routes
Route::post('/subscribe-newsletter', 'NewsletterController@subscribe')->name('web.newsletter');

// Add User By Admin Create Password Routes
Route::get('/create-password/{token}', 'UserController@changePassword')->name('web.createPassword');
Route::post('/change-password/{token}', 'UserController@updatePassword')->name('web.updatePassword');

// Forgot Password
Route::get('/reset', 'RecoverPasswordController@sendRequest');
Route::get('/forgot-password', 'RecoverPasswordController@resetForm')->name('forgot.password');
Route::post('/reset-password', 'RecoverPasswordController@sendRequest')->name('password.email');
Route::post('/update-password', 'RecoverPasswordController@recover')->name('password.update');
Route::get('/reset-password/{token}', 'RecoverPasswordController@recoverForm')->name('recover.password');


// Email Validation (By Ajax)
Route::post('/verify-email', 'UserController@verifyEmail');

// Renter  Validation (By Ajax)
Route::post('/verify-renter', 'UserController@renterCheck');

// License Verification (By Ajax)
Route::post('/verify-license', 'UserController@verifyLicense');
Route::get('/license-verification/{license_number}', 'NYCProxyController@licenseVerification');

// Login route for all user type
Route::post('/login')->name('attempt.login')->middleware('authguard');

// Route for Added Agent By Admin Signup
Route::post('/invited/agent/sign-up', 'UserController@createAddedAgentAccount')->name('web.createAddedAgentAccount');
Route::get('/agent/sign-up/{token}', 'UserController@addAgentByAdminSignUpForm')->name('web.addAgentByAdminSignUp');

// User Direct Signup Routes
Route::post('/agent/sign-up', 'UserController@agentSignUp')->name('web.agentSignUp');
Route::post('/renter/sign-up', 'UserController@renterSignUp')->name('web.renterSignUp');

// Agent to Agent Invitation SignUp
Route::post('/invited-agent/sign-up', 'UserController@invitedAgentSignUp')->name('web.agentToAgentInviteSignUp');
Route::get('/invited-agent/sign-up/{token}', 'UserController@invitedAgentSignUpForm')->name('web.agentToAgentInviteForm');

// Representative SignUp
Route::post('/invited-representative/sign-up', 'UserController@invitedRepresentativeSignUp')->name('web.invitedRepresentativeSignUp');
Route::get('/invited-representative/sign-up/{token}', 'UserController@invitedRepresentativeSignUpForm')->name('web.invitedRepresentativeSignUpForm');

// Existing Agent accept invitation
Route::get('/accept-invitation/{token}', 'UserController@acceptInvitation')->name('web.acceptInvitation');

// Email Confirmation (Direct Signed Up [Renter, Agent])
Route::get('/confirm-email/{token}', 'UserController@confirmEmail')->name('web.confirmEmail');

// Realty MX Routes
Route::get('/realty/{fileName}', 'RealtyMXController@dispatchJob');
Route::get('/realty-mx/{client}/{listing}', 'RealtyMXController@detail')->name('web.realty');

// Listing Routes
Route::post('/listing-detail', 'ListingController@detail');
Route::post('/is-unique-address', 'ListingController@isUnique');
Route::post('/is-owner-only', 'ListingController@isOwnerOnly');
Route::get('/listing-detail/{id}', 'ListingController@viewDetail')->name('listing.detail');

// Listing Conversation Routes
Route::post('/interested/{id}', 'ListingConversationController@interested');
Route::post('/send-request', 'ListingConversationController@create')->name('web.listConversation');

// Resend Email
Route::get('/resend-email/{token}', 'UserController@resendEmailView');
Route::post('/resend-email', 'UserController@resendEmail')->name('web.resendEmail');

// Notification Routes
Route::post('/delete-notification/{id}', 'NotificationController@delete');
Route::post('/read-notification/{id}', 'NotificationController@markAsRead');
Route::post('/mark-all-as-read', 'NotificationController@markAllAsRead');
Route::post('/push-notification', 'NotificationController@push');
Route::post('/fetch-notifications', 'NotificationController@get');
Route::get('/all-notifications', 'NotificationController@all');

// Review Routes
Route::get('/send-a-review/{token}', 'ReviewController@index')->name('web.makeReview');
Route::post('/create-review', 'ReviewController@create')->name('web.createReview');

// Favourite Routes
Route::get('/favourite/{listing_id}', 'UserController@favourite')->name('web.favouriteListing');
Route::get('/remove/favourite/{listing_id}', 'UserController@removeFavourite')->name('web.removeFavouriteListing');

// Listing Report
Route::post('/listing-report', 'ReportListingController@report')->name('web.reportListing');

//get Renters
Route::get('/get-renters', 'UserController@getRenters')->name('web.getRenters');

// Let Us Help
Route::post('/let-us-help', 'HomeController@letUsHelp')->name('web.letUsHelp');

// Get Started
Route::post('/get-started', 'HomeController@getStarted')->name('web.getStarted');

// Site Map Routes
Route::get('/site-map', 'SiteMapController@index')->name('web.siteMap');

// Advertise With Us Routes
Route::get('/advertise-with-us', 'AdvertiseController@index')->name('web.advertise');

// NYC Api Route
Route::post('/boroughs', 'NYCProxyController@boroughs');
Route::post('/nyc-data', 'NYCProxyController@nycData');

// Stripe WebHooks
//Route::stripeWebhooks('/v1/webhook_endpoints');

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

// Realty Import CSV Report Download
Route::get('/download/realty-csv-report', 'RealtyMXController@download');

use Workerman\Worker;
use PHPSocketIO\SocketIO;
// Test Route
Route::get('/test', function (\Illuminate\Http\Request $request) {
    dd(mySelf()->favourite, myId());
})->name('web.test');
