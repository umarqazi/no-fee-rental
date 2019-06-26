<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException as Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * @param  \Exception  $exception
	 * @return void
	 */
	public function report(Exception $exception) {
		if ($exception instanceof ModelNotFoundException) {
			dd('Requested Record Not Exist');
		}
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception) {
		return parent::render($request, $exception);
	}

	/**
	 * Render Auth Exception.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, Auth $exception) {
		if ($request->ajax() || $request->expectsJson()) {
			return response()->json(['message' => 'Request Not Allowed.'], 401);
		}
		switch ($exception->guards()[0]) {
		case 'admin':
			return redirect('/')->with(['message' => 'Your login session has been expired', 'alert_type' => 'error']);
			break;

		case 'agent':
			return redirect('/')->with(['message' => 'Your login session has been expired', 'alert_type' => 'error']);
			break;

		case 'renter':
			// code...
			break;

		case 'owner':
			// code...
			break;

		default:
			return redirect('/')->with(['message' => 'Your login session has been expired']);
			break;
		}
		return abort(401);
	}
}
