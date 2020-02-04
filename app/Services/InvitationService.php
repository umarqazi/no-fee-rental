<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/22/20
 * Time: 6:08 PM
 */

namespace App\Services;

use App\Forms\InvitationForm;
use App\Repository\InvitationRepo;
use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;

/**
 * Class InvitationService
 * @package App\Services
 */
class InvitationService {

    use DispatchNotificationService;

    /**
     * @var UserRepo
     */
    protected $userRepo;

    /**
     * @var InvitationRepo
     */
    protected $invitationRepo;

    /**
     * InvitationService constructor.
     */
    public function __construct() {
        $this->userRepo = new UserRepo();
        $this->invitationRepo = new InvitationRepo();
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function invite($request) {
        if($this->__isAlreadyExist($request->email)) {
            return $this->__sendAddMemberEmail($request);
        }

        return $this->__create($request);
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function addRepresentative($request) {
        if($request->representative_exists == 'true') {
//            $this->__sendRepresentativeEmail($request);
            $user = $this->userRepo->find(['email' => $request->email])->first();
            return $user->id;
        }

        return $this->__create($request) ? $this->__addUser($request) : false;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function checkExistence($email) {
        return $this->userRepo->find(['email' => $email])->first();
    }

    /**
     * @param $email
     * @return bool
     */
    private function __isAlreadyExist($email) {
        return $this->userRepo->find(['email' => $email])->count > 0 ? true : false;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function __addUser($request) {
        $first_name = null;
        $last_name  = null;
        $username = $request->username ?? null;

        if($username != null) {
            $username = collect(explode(' ', $username));
        }

        if($username != null || is_array($username)) {
            $first_name = $username->first();
            $last_name  = $username->last();
        }

        $user = $this->userRepo->create([
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'user_type'  => AGENT,
            'email'      => $request->email
        ]);

        return $user->id;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function __create($request) {
        $invitation = $this->__validateForm($request);
        $this->__sendInvitationEmail($invitation);
        return $this->invitationRepo->create($invitation->toArray());
    }

    /**
     * @param $request
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function __sendInvitationEmail($request) {
        return DispatchNotificationService::AGENTINVITE($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function __sendRepresentativeEmail($request) {
        return DispatchNotificationService::ADDREPRESENTATIVE($request);
    }

    /**
     * @param $request
     * @return bool
     */
    private function __sendAddMemberEmail($request) {
        return DispatchNotificationService::ADDMEMBER($request);
    }

    /**
     * @param $request
     * @return InvitationForm
     */
    private function __validateForm($request) {
        $form = new InvitationForm();
        $form->invite_by = myId();
        $form->email     = $request->email;
        $form->token     = str_random(60);
        $form->validate();

        return $form;
    }
}