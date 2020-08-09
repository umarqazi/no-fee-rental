<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthService
 * @package App\Services
 */
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
     * @param $id
     * @return mixed
     */
    public function loginUsingId($id) {
        return $this->guard()->loginUsingId($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|Response
     * @throws ValidationException
     */
    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return sendResponse($request, false, null, null, 'Too many wrong attempts. Try to login after 1 minute');
        }

        if ($this->attemptLogin($request)) {
            //dispatchPlanExpiryCheckListener();

            $url = route("{$this->guard}.index");

            if(session()->has('__destination')) {
                $url = decrypt(session()->get('__destination'));
                session()->forget('__destination');
            }

            return sendResponse($request, ['url' => $url], null);
        }

        $this->incrementLoginAttempts($request);

        return ($request->ajax())
                ? json('Wrong Email or Password.', null, false)
                : $this->sendFailedLoginResponse($request);
    }

    /**
     * @return mixed
     */
    protected function guard() {
        return Auth::guard($this->guard);
    }
}
