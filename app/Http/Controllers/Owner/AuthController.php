<?php

/**
 * Created by PhpStorm.
 * author: Yousuf
 * Date: 6/11/19
 * Time: 4:30 PM
 */

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers\Owner
 */
class AuthController extends Controller {

    /**
     * @var AuthService
     */
    private $authService;

    /**
     * AuthController constructor.
     */
	public function __construct() {
	    $this->authService = new AuthService('owner');
		$this->middleware('guest:owner')->except('logout');
	}

    /**
     * @param Request $request
     *
     * @return JsonResponse|\Illuminate\Http\Response|Response|void
     * @throws ValidationException
     */
	public function login(Request $request) {
        return $this->authService->login($request);
	}

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        return $this->authService->logout($request);
    }
}
