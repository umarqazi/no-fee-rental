<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/22/20
 * Time: 6:08 PM
 */

namespace App\Services;

use App\Forms\CompanyForm;
use App\Forms\InvitationForm;
use App\Forms\InvitedAgentSignUpForm;
use App\Repository\CompanyRepo;
use App\Repository\InvitationRepo;
use App\Repository\MemberRepo;
use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\DB;

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
     * @var MemberRepo
     */
    protected $memberRepo;

    /**
     * @var CompanyRepo
     */
    protected $companyRepo;
    /**
     * @var InvitationRepo
     */
    protected $invitationRepo;

    /**
     * InvitationService constructor.
     */
    public function __construct() {
        $this->userRepo = new UserRepo();
        $this->memberRepo = new MemberRepo();
        $this->companyRepo = new CompanyRepo();
        $this->invitationRepo = new InvitationRepo();
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function invite($request) {
        DB::beginTransaction();

        if($agent = $this->__isAlreadyExist($request->email)) {
            return $this->__sendAddMemberEmail($agent);
        }

        if(!$invitation = $this->__isAlreadyInvited($request->email)) {
            $res = $this->__sendInvitation($request);
            $request->request->add(['token' => $res->token]);
        } else {
            $request->request->add(['already_invited' => $invitation]);
            $this->__updateInvitation($request);
        }

        DB::commit();
        return $this->__sendAgentInvitationEmail($request);
    }

    /**
     * @param $token
     * @return bool|mixed
     */
    public function addMember($token) {
        $request = decrypt($token);
        if($user = $this->userRepo->findById($request['member_id'])->first()) {
            return $this->memberRepo->create($request);
        }

        return false;
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function addInvitedAgentSignUp($request) {
        DB::beginTransaction();
        if($agent = $this->validateInvitedAgentToken($request->token)) {
            $form = $this->__validateInvitedAgentForm($request);
            if($user = $this->userRepo->create($form->toArray())) {
                $this->memberRepo->create(['agent_id' => $agent->invited_by, 'member_id' => $user->id]);
                DB::commit();
                return (new AuthService('agent'))->loginUsingId($user->id);
            }
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $request
     * @return string
     */
    public function validateEmail($request) {
        if($agent = $this->__isAlreadyExist($request->email)) {
            return $agent->user_type === AGENT ? 'true' : 'false';
        }

        return 'true';
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function addRepresentative($request) {
        DB::beginTransaction();
        if($request->representative_exists == 'true') {
            $this->__sendAddRepresentativeEmail($request);
            $user = $this->userRepo->find(['email' => $request->email])->first();
            return $user->id;
        }

        if($invitation = $this->__create($request)) {
            $user = $this->__addUser($request);
            $this->__sendRepresentativeInviteEmail($user, $invitation);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function checkExistence($email) {
        $res = $this->userRepo->find(['email' => $email])->first();
        if(!empty($res) && $res->user_type == AGENT) {
            return $res;
        } elseif ($res) {
            return null;
        }

        return false;
    }

    /**
     * @param $token
     * @return bool
     */
    public function validateInvitedAgentToken($token) {
        $agent = $this->invitationRepo->find(['token' => $token]);
        return $agent->count() > 0 ? $agent->first() : false;
    }

    /**
     * @param $email
     * @return bool
     */
    private function __isAlreadyExist($email) {
        $agent = $this->userRepo->find(['email' => $email]);
        return $agent->count() > 0 ? $agent->first() : false;
    }

    /**
     * @param $email
     * @return bool
     */
    private function __isAlreadyInvited($email) {
        $invitation = $this->invitationRepo->find(['email' => $email]);
        return $invitation->count() > 0 ? $invitation->first() : false;
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
            'email'      => $request->email,
            'remember_token' => str_random(60)
        ]);

        return $user;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function __sendInvitation($request) {
        $invitation = $this->__validateForm($request);
        return $this->invitationRepo->create($invitation->toArray());
    }

    /**
     * @param $request
     * @return mixed
     */
    private function __updateInvitation($request) {
        $invitation = $this->__validateForm($request);
        dd($request->all());
        return $this->invitationRepo->updateByClause([
            'id' => $request->already_invited->id
        ], $invitation->toArray());
    }

    /**
     * @param $request
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function __sendAgentInvitationEmail($request) {
        return DispatchNotificationService::AGENTINVITE($request);
    }

    /**
     * @param $request
     * @param $invitation
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    private function __sendRepresentativeInviteEmail($request, $invitation) {
        return DispatchNotificationService::REPRESENTATIVEINVITE($request, $invitation);
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
     * @return bool
     */
    private function __sendAddRepresentativeEmail($request) {
        return DispatchNotificationService::ADDREPRESENTATIVE($request);
    }

    /**
     * @param $request
     * @return mixed|null
     */
    private function __manageCompany($request) {

        if(!isset($request->company)) {
            return null;
        }

        $company = $this->__validateCompanyForm($request);

        if (!$company->fails()) {
            $company= $this->companyRepo->create($company->toArray());
        } else {
            $company = $this->companyRepo->find(['company' => $request->company])->first();
        }

        return $company->id;
    }

    /**
     * @param $request
     * @return CompanyForm
     */
    private function __validateCompanyForm($request) {
        $form = new CompanyForm();
        $form->company = $request->company;
        return $form;
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

    /**
     * @param $request
     * @return InvitedAgentSignUpForm
     */
    private function __validateInvitedAgentForm($request) {
        $form = new InvitedAgentSignUpForm();
        $form->first_name     = $request->first_name;
        $form->last_name      = $request->last_name;
        $form->email          = $request->email;
        $form->phone_number   = $request->phone_number;
        $form->password       = bcrypt($request->password);
        $form->license_number = $request->license_number;
        $form->user_type      = AGENT;
        $form->company        = $this->__manageCompany($request);
        $form->validate();

        return $form;
    }
}