<?php

namespace App\Http\Middleware;

use Closure;

class AuthGuardAssign {

    /**
     * @var
     */
	protected $request;

    /**
     * @param $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
	public function handle($request, Closure $next) {
		$this->request = $request;
		$user = $this->check_type();
		if (empty($user)) {
			$msg = 'Wrong Email or Password.';
			return ($request->ajax()) ? json($msg, null, false) : error($msg);
		}
		switch ($user->user_type) {
		case ADMIN:
			return (new \App\Http\Controllers\Admin\AuthController)->login($this->request);
			break;

		case AGENT:
			return (new \App\Http\Controllers\Agent\AuthController)->login($this->request);
			break;

		case RENTER:
			return (new \App\Http\Controllers\AuthController)->login($this->request);
			break;
		}
		return $next($this->request);
	}

	/**
	 * @return mixed
	 */
	private function check_type() {
		return \App\User::whereEmail($this->request->email)->select(['user_type'])->first();
	}
}
