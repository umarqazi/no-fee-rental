<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService {

    use AuthenticatesUsers;

    /**
     * @var string
     */
    private $guard;

    /**
     * AuthService constructor.
     *
     * @param $guard
     */
    public function __construct($guard) {
        $this->guard = $guard;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return ($request->ajax())
                    ? response()->json(['data' => ['url' => "/{$this->guard}/home"], 'status' => true])
                    : $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return ($request->ajax())
                ? json('Wrong Email or Password.', null, false)
                : $this->sendFailedLoginResponse($request);
    }

    /**
     * Use to override custom guard
     *
     * @return guard instance
     */
    protected function guard() {
        return Auth::guard($this->guard);
    }
}
