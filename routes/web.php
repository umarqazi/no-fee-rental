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

// Guest Auth Routes Group
Auth::routes();

Route::get('/', 'HomeController@home');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/renter-guide', function () {
	return view('pages.renter-guide');
});
Route::get('/contact-us', function () {
	return view('pages.contact-us');
})->name('contact-us');
Route::post('contact-us', 'ContactUsController@contactUs')->name('contact-us');
Route::get('/press', function () {
	return view('pages.press');
})->name('press');
// Route::get('/change-password/{id}', 'UserController@changePassword')->name('change-password');
Route::post('/change-password', 'UserController@updatePassword')->name('change-password');
Route::post('newsletter', 'NewsletterController@store');

// Login route for all user type
Route::post('/login')->name('attempt.login')->middleware('authguard');

// Route for Invited Agent Signup
Route::get('/signup/{token}', function ($token) {
	$authenticate_token = \App\AgentInvites::select(['id', 'token', 'invitation_email'])->whereToken($token)->first();
	if (!empty($authenticate_token) && $authenticate_token->token == $token) {
		return view('invited_agent_signup', compact('authenticate_token'));
	}

	return redirect('/')->with(['message' => 'Invalid token request cannot be processed.', 'alert_type' => 'error']);
})->name('agent.signup_form');

Route::post('/agent/signup', 'UserController@invited_agent_sign_up')->name('agent.signup');