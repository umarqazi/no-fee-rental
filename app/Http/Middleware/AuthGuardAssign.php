<?php

namespace App\Http\Middleware;

use Closure;

class AuthGuardAssign {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$user = \App\User::whereEmail($request->email)->select('user_type')->first();
		if (empty($user)) {
			return redirect()->back()->with(['message' => 'Wrong Email or Password.', 'alert_type' => 'error']);
		}
		switch ($user->user_type) {
		case 1:
			return (new \App\Http\Controllers\Admin\LoginController)->login($request);
			break;

		case 2:
			return (new \App\Http\Controllers\Agent\LoginController)->login($request);
			break;

		case 3:
			return (new \App\Http\Controllers\Auth\LoginController)->login($request);
			break;

		default:
			return redirect()->back();
			break;
		}
		return $next($request);
	}
}
