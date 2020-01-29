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
Route::get('/search', 'SearchController@indexSearch')->name('web.indexSearch');
Route::get('/advance-search', 'SearchController@advanceSearch')->name('web.advanceSearch');
Route::get('/advance-search-filter', 'SearchController@filter')->name('web.advanceSearchFilter');

// Contact Us Routes
Route::get('/contact-us', 'ContactUsController@index')->name('web.contact-us');
Route::post('/contact-us', 'ContactUsController@sendRequest')->name('web.sendRequest');

// subscription through mail chimp
Route::post('/newsletter-subscribe', 'NewsletterController@subscribe')->name('newsLetter-subscription');

// Wordpress Pages
Route::get('/press', 'ContactUsController@showPress')->name('press');
Route::post('newsletter', 'NewsletterController@store');

// Profile Routes
Route::get('/profile/{agentId}', 'UserController@agentProfileWithListing')->name('web.agentProfile');
Route::get('/profile-search-filters/{agentId}', 'UserController@agentProfileSearchFilter')->name('web.agentProfileSearchFilter');
Route::get('/profile-advance-search/{agentId}', 'UserController@agentProfileAdvanceSearch')->name('web.agentProfileAdvanceSearch');

// Add User By Admin Change Password Routes
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

// Renter  Validation
Route::post('/verify-renter', 'UserController@renterCheck');

// License Routes
Route::post('/verify-license', 'UserController@verifyLicense');
Route::get('/license-verification/{license_number}', 'NYCProxyController@licenseVerification');

// Login route for all user type
Route::post('/login')->name('attempt.login')->middleware('authguard');

// Route for Invited Agent Signup
Route::get('/signup/{token}', 'UserController@invitedAgentSignupForm')->name('agent.signup_form');

// User Signup Routes
Route::post('/user-signup', 'UserController@signup')->name('user.signup');
Route::post('/agent/signup', 'UserController@invitedAgentSignup')->name('agent.signup');
Route::post('/renter-signup', 'UserController@renterSignup')->name('renter.signup');

// Messaging Routes
Route::post('/send-message', 'MessageController@send')->name('send.message');

// Realty MX Routes
Route::get('/realty/{file}', 'RealtyMXController@dispatchJob');
Route::get('/realty-mx/{client}/{listing}', 'RealtyMXController@detail')->name('web.realty');

// Listing Routes
Route::post('/listing-detail', 'ListingController@detail');
Route::post('/is-unique-address', 'ListingController@isUnique');
Route::post('/is-owner-only', 'ListingController@isOwnerOnly');
Route::get('/listing-detail/{id}', 'ListingController@viewDetail')->name('listing.detail');

// Listing Conversation Routes
Route::post('/send-request', 'ListingConversationController@create')->name('web.listConversation');

// Notification Routes
Route::post('/delete-notification/{id}', 'NotificationController@delete');
Route::post('/read-notification/{id}', 'NotificationController@markAsRead');
Route::post('/mark-all-as-read', 'NotificationController@markAllAsRead');
Route::post('/push-notification', 'NotificationController@push');
Route::post('/fetch-notifications', 'NotificationController@get');
Route::get('/all-notifications', 'NotificationController@all');

// Rent Routes
Route::get('/listing-by-rent/{sort}', 'RentController@sort');
Route::get('/find-apartments/{price}', 'RentController@findApartment');
Route::get('/listing-by-rent', 'RentController@index')->name('web.ListsByRent');
Route::get('/listing-by-rent-filter', 'RentController@filter')->name('web.rentFilter');
Route::get('/listing-by-rent-search', 'RentController@advanceSearch')->name('web.advanceRentSearch');

// Neighborhood Routes
Route::post('/all-neighborhoods', 'NeighborhoodController@all');
Route::get('/listing-by-neighborhood', 'NeighborhoodController@index')->name('web.neighborhood');
Route::get('/listing-by-neighborhood/filter', 'NeighborhoodController@filter')->name('web.neighborhoodFilter');
Route::get('/listing-by-neighborhood/advance-search', 'NeighborhoodController@advanceSearch')->name('web.advanceNeighborhoodSearch');
Route::match(['get', 'post'], '/listing-by-neighborhood/{neighborhood}', 'NeighborhoodController@find')->name('web.ListsByNeighborhood');

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

// Member accept invitation
Route::get('/accept-invitation/{token}', 'Agent\MemberController@acceptInvitation')->name('member.acceptInvitation');

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

use App\Traits\DispatchNotificationService;
// Test Route
Route::get('/test', function (\Illuminate\Http\Request $request) {
    $ser = new \App\Services\SaveSearchService();
    $data = [
        'beds' => 2,
        'baths' => 3,
        'neighborhood' => 'Harlem',
    ];

    $ser->match($data);
})->name('web.test');
