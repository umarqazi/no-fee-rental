<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * @var AuthService
     */
    private $service;

    /**
     * AuthController constructor.
     */
    public function __construct() {
        $this->service = new AuthService('');
        $this->middleware('guest')->except('logout');
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
