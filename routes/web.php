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

Route::get('/', 'HomeController@home');

Auth::routes();
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
Route::get('/change-password/{id}', 'UserController@changePassword')->name('change-password');
// Route::post('/change-password', 'UserController@updatePassword')->name('change-password');

// Login route for all user type
Route::post('/login')->name('attempt.login')->middleware('authguard');

// Route for Invited Agent Signup
Route::get('/signup', function () {
	return view('signup');
})->name('agent.signup');