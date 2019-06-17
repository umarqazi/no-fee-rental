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

Route::get('/', function () {
    return view('index');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/renter-guide', function () {
    return view('pages/renter-guide');
});
Route::get('/contact-us', function () {
    return view('pages/contact-us');
})->name('contact-us');
Route::post('contact-us', 'ContactUsController@contactUs')->name('contact-us');
Route::get('/press', function () {
    return view('pages/press');
})->name('press');
Route::get('/change-password', 'UserController@changePassword')->name('change-password');
Route::post('/change-password', 'UserController@updatePassword')->name('change-password');
/*** admin routes ***/
Route::group(array('prefix' => 'admin'), function() {
    Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin-dashboard');
    Route::get('/profile', 'Admin\AdminController@profile')->name('profile');
    Route::post('/profile', 'UserController@editProfile')->name('edit-profile');
    Route::get('/property-listing', 'Admin\AdminController@viewPropertyListing')->name('property-listing');
});
