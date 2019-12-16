<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthController
 * @package App\Http\Controllers
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
        $this->authService = new AuthService('');
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws ValidationException
     */
    public function login(Request $request) {
        return $this->authService->login($request);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function logout(Request $request) {
        return $this->authService->logout($request);
    }
}
