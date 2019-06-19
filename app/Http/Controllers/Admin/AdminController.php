<?php

namespace App\Http\Controllers\Admin;

use App\Forms\User\UserForm;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class AdminController extends Controller {

	private $service;

	public function __construct(UserService $service) {
		$this->service = $service;
	}

	public function addUsers(Request $request) {
		return ($this->service->createUser(new UserForm($request)))
		? success('User has been added succesfully')
		: error('Something went wrong');
	}
}
