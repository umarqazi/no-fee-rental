<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Repository\UserRepo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Forms\ResetPasswordForm;
use App\Repository\PasswordResetRepo;

class RecoverPasswordService {

    /**
     * @var PasswordResetRepo
     */
    private $repo;

    /**
     * @var UserRepo
     */
    private $userRepo;

    /**
     * RecoverPasswordService constructor.
     *
     * @param PasswordResetRepo $repo
     * @param UserRepo $userRepo
     */
    public function __construct(PasswordResetRepo $repo, UserRepo $userRepo) {
        $this->repo = $repo;
        $this->userRepo = $userRepo;
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
        return ($res = $this->repo->validateToken($token)) ? $res->token : false;
    }

    /**
     * @param $token
     * @param $email
     *
     * @return bool
     */
    private function isValidEmail($token, $email) {
        if($res = $this->repo->existingRequest($token)) {
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
        return $this->repo->create($form->toArray());
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function mailData($data) {
        return [
            'subject' => 'Reset Password Email',
            'view'    => 'reset-password',
            'route'   => route('recover.password', $data->token)
        ];
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
            $response = $this->makeHistory( $request );
            if ( ! empty( $response ) ) {
                $this->setExpiry( $response->token );
                mailService( $response->email, toObject( $this->mailData( $response ) ) );
                DB::commit();

                return true;
            }
        }
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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function resetForm($token) {
        $token = $this->validateToken($token);
        return (!empty($token)) ? view('auth.passwords.reset')->with('token', $token) : abort(404);
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function recover($request) {
        if($this->isValidEmail($request->token, $request->email)) {
            DB::beginTransaction();
            $this->repo->deleteMultiple(['token' => $request->token]);
            $this->userRepo->updateByClause(['email' => $request->email], ['password' => bcrypt($request->password)]);
            DB::commit();
            return true;
        }

            DB::rollBack();
            return false;
    }
}
