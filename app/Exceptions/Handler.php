<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
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
        if ($this->isHttpException($exception)) {
            if ($exception instanceof NotFoundHttpException) {
                $errors = collect();
                return response()->view('404', compact('errors'), 404);
            }

            return $this->renderHttpException($exception);
        }

        return parent::render($request, $exception);
	}

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param Auth $exception
	 *
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
	 */
//	protected function unauthenticated($request, Auth $exception) {
//
//		if ($request->ajax() || $request->expectsJson() || $exception->guards()[0]) {
//			return redirect(route('web.index'));
//		}
//	}
}
