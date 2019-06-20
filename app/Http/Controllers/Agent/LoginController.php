<?php

/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/agent/home';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest:agent')->except('logout');
	}

	/**
	 * Use to override custom guard
	 *
	 * @return guard instance
	 */
	protected function guard() {
		return Auth::guard('agent');
	}
}
