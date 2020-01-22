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

    public function send($request) {
        if($this->__isAlreadyExist($request->email)) {

        }

        return $this->__create($request);
    }

    public function verify() {

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

    private function __sendInvitationEmail($request) {
        DispatchNotificationService::AGENTINVITE(toObject([
            'to'   => $request->email,
            'from' => nycSupportEmail(),
            'data' => $request
        ]));
    }

    private function __sendInformEmail() {

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