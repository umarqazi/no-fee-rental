<?php

namespace App\Http\Controllers;

use App\Services\RecoverPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class RecoverPasswordController extends Controller
{
    /**
     * @var RecoverPasswordService
     */
    private $service;

    /**
     * RecoverPasswordController constructor.
     *
     * @param RecoverPasswordService $service
     */
    public function __construct(RecoverPasswordService $service) {
        $this->service = $service;
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetForm() {
        return $this->service->linkRequestForm();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recoverForm(Request $request, $token) {
        return $this->service->resetForm($token);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function sendRequest(Request $request) {
        $res = $this->service->sendEmail($request);
        return sendResponse($request, $res, 'We Send an Email to your account', '/','invalid Email');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function recover(Request $request) {
        return sendResponse($request, $this->service->recover($request), 'Your password has been reset.', '/', 'Invalid Email');
    }
}
