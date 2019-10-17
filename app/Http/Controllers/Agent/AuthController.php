<?php

/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller {

    /**
     * @var AuthService
     */
    private $service;

    /**
     * AuthController constructor.
     */
	public function __construct() {
	    $this->service = new AuthService('agent');
		$this->middleware('guest:agent')->except('logout');
	}

    /**
     * @param Request $request
     *
     * @return JsonResponse|\Illuminate\Http\Response|Response|void
     * @throws ValidationException
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
