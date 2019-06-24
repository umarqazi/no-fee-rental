<?php

namespace App\Http\Controllers\Admin;

use App\Forms\User\UserForm;
use App\Http\Controllers\Controller;
use App\Services\UserServices;
use Illuminate\Http\Request;

class AdminController extends Controller {

	private $service;

	function __construct(UserServices $service) {
		$this->service = $service;
	}

	function addUser(Request $request) {
		return ($this->service->registerUser(new UserForm($request)))
		? success('User has been added succesfully')
		: error('Something went wrong');
	}

	function profile() {
		$user = auth()->user();
		return view('admin.profile', compact('user'));
	}

	function resetPassword() {
		return view('admin.auth.passwords.reset');
	}

	function profileUpdate(Request $request) {
		dd($request);
	}

	function updatePassword(Request $request) {

	}
}
