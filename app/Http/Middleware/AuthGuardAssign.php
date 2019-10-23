<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthGuardAssign
 * @package App\Http\Middleware
 */
class AuthGuardAssign {

    /**
     * @var mixed
     */
	protected $request;

    /**
     * @param $request
     * @param Closure $next
     *
     * @return JsonResponse|RedirectResponse|Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws ValidationException
     */
	public function handle($request, Closure $next) {
		$this->request = $request;
		$user = $this->__userType();
		if (empty($user)) {
			$msg = 'Wrong Email or Password.';
            return sendResponse($request, false, null, null, $msg);
		} else if(empty($user->email_verified_at)) {
		    $msg = 'Your Email is not verified';
            return sendResponse($request, false, null, null, $msg);
        }

		switch ($user->user_type) {
            case ADMIN:
                return (new \App\Http\Controllers\Admin\AuthController)->login($this->request);
                break;

            case AGENT:
                return (new \App\Http\Controllers\Agent\AuthController)->login($this->request);
                break;

            case OWNER:
                return (new \App\Http\Controllers\Owner\AuthController)->login($this->request);
                break;

            case RENTER:
                return (new \App\Http\Controllers\Renter\AuthController)->login($this->request);
                break;
		}
		return $next($this->request);
	}

	/**
	 * @return mixed
	 */
	private function __userType() {
		return \App\User::whereEmail($this->request->email)->select(['user_type', 'email_verified_at'])->first();
	}
}
