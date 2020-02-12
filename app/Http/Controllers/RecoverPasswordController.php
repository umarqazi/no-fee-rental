<?php

namespace App\Http\Controllers;

use App\Services\RecoverPasswordService;
use Illuminate\Http\Request;

/**
 * Class RecoverPasswordController
 * @package App\Http\Controllers
 */
class RecoverPasswordController extends Controller
{
    /**
     * @var RecoverPasswordService
     */
    private $passwordRecoveryService;

    /**
     * RecoverPasswordController constructor.
     */
    public function __construct() {
        $this->middleware('guest');
        $this->passwordRecoveryService = new RecoverPasswordService();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetForm() {
        return $this->passwordRecoveryService->linkRequestForm();
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recoverForm($token) {
        if($this->passwordRecoveryService->resetForm($token)) {
            return view('auth.passwords.reset')->with('token', $token);
        }

        return error('You token has been expired.');
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function sendRequest(Request $request) {
        $res = $this->passwordRecoveryService->sendEmail($request);
        return sendResponse($request, $res,
            'We Send an Email to your account', null, 'invalid Email');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function recover(Request $request) {
        $res = $this->passwordRecoveryService->recover($request);
        return sendResponse($request, $res,
            'Your password has been reset.', null, 'Invalid Email');
    }
}
