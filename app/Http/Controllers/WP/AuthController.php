<?php

namespace App\Http\Controllers\WP;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

/**
 * Class AuthController
 * @package App\Http\Controllers\WP
 */
class AuthController extends Controller {

    use AuthenticatesUsers;

    /**
     * @var object
     */
    private $data;

    private $guard;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request) {
        $this->data = toObject($request->all());
        if($user = $this->__verifyUser()) {
            $this->__webLogin($request);
            return response()->json([
                'status' => true,
                'guard' => $this->__guardAssign($user),
                'msg' => 'Authentication successful',
                'api_token' => $user->api_token
            ], 200);
        }

        return response()->json([
            'status' => false,
            'msg' => 'Wrong email or password',
        ], 401);
    }

    /**
     * @param $request
     * @return bool|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    private function __webLogin($request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return true;
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @return mixed
     */
    private function __verifyUser() {
        $auth = null;
        $user = \App\User::where('email', $this->data->email)->first();
        if(!empty($user)) {
            $auth = Hash::check($this->data->password, $user->password);
        }

        return ($user && $auth) ? $user : false;
    }

    /**
     * @param $user
     * @return string|null
     */
    private function __guardAssign($user) {
        $guard = null;
        switch($user->user_type) {
            case ADMIN:
                $this->guard = 'admin';
                break;
            case AGENT:
                $this->guard = 'agent';
                break;
            case OWNER:
                $this->guard = 'owner';
                break;
            case RENTER:
                $this->guard = 'renter';
                break;
        }

        return $guard;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard(){
        return Auth::guard($this->guard);
    }
}
