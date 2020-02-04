<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Forms\ResetPasswordForm;
use App\Repository\PasswordResetRepo;

/**
 * Class RecoverPasswordService
 * @package App\Services
 */
class RecoverPasswordService {

    use DispatchNotificationService;

    /**
     * @var UserRepo
     */
    private $userRepo;

    /**
     * @var PasswordResetRepo
     */
    private $recoverPasswordRepo;

    /**
     * RecoverPasswordService constructor.
     */
    public function __construct() {
        $this->userRepo = new UserRepo();
        $this->recoverPasswordRepo = new PasswordResetRepo();
    }

    /**
     * @param $length
     *
     * @return string
     */
    private function generateToken($length) {
        return str_random($length);
    }

    /**
     * @param $token
     *
     * @return bool
     */
    private function validateToken($token) {
        if(!Session::has('token')) abort(401);
        return $this->recoverPasswordRepo->validateToken($token) ? true : false;
    }

    /**
     * @param $token
     * @param $email
     *
     * @return bool
     */
    private function isValidEmail($token, $email) {
        if($res = $this->recoverPasswordRepo->validateToken($token)) {
            return $email == $res->email;
        }

        return false;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    private function makeHistory($request) {
        $form = new ResetPasswordForm();
        $form->email = $request->email;
        $form->token = $this->generateToken(60);
        $form->validate();
        return $this->recoverPasswordRepo->create($form->toArray());
    }

    /**
     * @param $token
     */
    private function setExpiry($token) {
        Session::put('token', $token);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    private function isValidRequest($request) {
        return $this->userRepo->findByEmail($request->email) ? true : false;
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function sendEmail($request) {
        DB::beginTransaction();
        if($this->isValidRequest($request)) {
            if ($response = $this->makeHistory( $request )) {
                $this->setExpiry( $response->token );
                DispatchNotificationService::RESETPASSWORD($response);
                DB::commit();
                return true;
            }
        }

        DB::rollBack();
        return false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function linkRequestForm() {
        return view('auth.passwords.email');
    }

    /**
     * @param $token
     * @return bool
     */
    public function resetForm($token) {
        return $this->validateToken($token);
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function recover($request) {
        if($this->isValidEmail($request->token, $request->email)) {
            DB::beginTransaction();
            if($this->recoverPasswordRepo->deleteMultiple(['token' => $request->token])) {
                $this->userRepo->updateByClause(['email' => $request->email], ['password' => bcrypt($request->password)]);
                DB::commit();
                return true;
            }
        }

        DB::rollBack();
        return false;
    }
}
