<?php

/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller {

    /**
     * @var AuthService
     */
    private $service;

    /**
     * LoginController constructor.
     */
	public function __construct() {
        $this->service = new AuthService('admin');
		$this->middleware('guest:admin')->except('logout');
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
	public function login(Request $request) {
		return $this->service->login($request);
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
	public function logout(Request $request) {
	    return $this->service->logout($request);
    }
}
