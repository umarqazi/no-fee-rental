<?php

namespace App\Http\Middleware;

use Closure;

class AuthGuardAssign {

	protected $request;
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$this->request = $request;
		$user = $this->check_type();
		if (empty($user)) {
			$msg = 'Wrong Email or Password.';
			return ($request->ajax()) ? json($msg, null, false) : error($msg);
		} else if (!$user->status) {
			$msg = 'Your account status is not active. Contact Administrator';
			return ($request->ajax()) ? json($msg, null, false) : error($msg);
		}

		switch ($user->user_type) {
		case 1:
			return (new \App\Http\Controllers\Admin\LoginController)->login($this->request);
			break;

		case 2:
			return (new \App\Http\Controllers\Agent\LoginController)->login($this->request);
			break;

		case 3:
			return (new \App\Http\Controllers\Auth\LoginController)->login($this->request);
			break;

		default:
			return redirect()->back();
			break;
		}
		return $next($this->request);
	}

	/**
	 * @return mixed
	 */
	private function check_type() {
		return \App\User::whereEmail($this->request->email)->select(['user_type', 'status'])->first();
	}
}
