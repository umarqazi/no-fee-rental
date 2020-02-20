<?php

namespace App\Http\Controllers\Renter;

use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Renter
 */
class ProfileController extends Controller {

    /**
     * @var UserService
     */
    private $userService;

    /**
     * ProfileController constructor.
     */
    public function __construct() {
        $this->userService = new UserService();
    }

    /**
     * @return Factory|View
     */
    public function profile() {
        return view('renter.profile');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function updateProfile(Request $request) {
        $res = $this->userService->updateProfile($request);
        return sendResponse($request, $res, 'Profile has been updated.');
    }

    /**
     * @return Factory|View
     */
    public function resetPassword() {
        return view('renter.update_password');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function updatePassword(Request $request) {
        $update = $this->userService->changePassword($request);
        return sendResponse($request, $update, 'Password has been updated.');
    }
}
