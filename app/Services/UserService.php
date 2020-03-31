<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\CompanyForm;
use App\Forms\CreateUserByAdminForm;
use App\Forms\InvitedAgentSignUpForm;
use App\Forms\SignUpForm;
use App\Forms\User\ChangePasswordForm;
use App\Forms\User\EditProfileForm;
use App\Repository\CompanyRepo;
use App\Repository\ExclusiveSettingRepo;
use App\Repository\MemberRepo;
use App\Repository\AgentRepo;
use App\Repository\NeighborhoodRepo;
use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class UserService extends SearchService {

    use DispatchNotificationService;

    /**
     * @var UserRepo
     */
    private $userRepo;

    /**
     * @var AgentRepo
     */
    private $agentRepo;

    /**
     * @var CompanyRepo
     */
    private $companyRepo;

    /**
     * @var neighborhoodRepo
     */
    private $neighborhoodRepo;

    /**
     * @var mixed
     */
    private $exclusiveSettingRepo;

    /**
     * UserService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->userRepo = new UserRepo();
        $this->companyRepo = new CompanyRepo();
        $this->agentRepo = new AgentRepo();
        $this->neighborhoodRepo = new NeighborhoodRepo();
        $this->exclusiveSettingRepo = new ExclusiveSettingRepo();
    }

    /**
     * @param $request
     * @return bool
     */
    public function agentSignup($request) {
        DB::beginTransaction();
        $form = $this->__validateDirectSignUpForm($request);
        if($user = $this->userRepo->isUniqueEmail($form->email)) {
            if($this->userRepo->update($user->id, $form->toArray())) {
                $user = $this->userRepo->isUniqueEmail($form->email);
                DispatchNotificationService::USERSIGNUP($user);
                DB::commit();
                return $user->remember_token;
            }

            DB::rollBack();
            return false;
        }

        if($user = $this->userRepo->create($form->toArray())) {
            DispatchNotificationService::USERSIGNUP($user);
            DB::commit();
            return $user->remember_token;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function renterSignup($request){
        DB::beginTransaction();
        $form = $this->__validateDirectSignUpForm($request);
        if($user = $this->userRepo->create($form->toArray())) {
            DispatchNotificationService::USERSIGNUP($user);
            DB::commit();
            return $user->remember_token;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $request
     * @return bool|mixed
     */
    public function addByAdminAgentSignUp($request) {
        DB::beginTransaction();
        $form = $this->__validateInvitedAgentForm($request);
        if($user = $this->validateRememberToken($request->token)) {
            if($this->userRepo->update($user->id, $form->toArray())) {
                DB::commit();
                return (new AuthService('agent'))->loginUsingId($user->id);
            }
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $token
     * @return bool|mixed
     */
    public function verifyEmail($token) {
        $user = $this->validateRememberToken($token);
        if (isset($user) && !empty($user)) {
            if($this->userRepo->update($user->id, ['email_verified_at' => now(), 'status' => ACTIVE])) {
                $this->addExclusiveSettings($user->id);
                return (new AuthService($user->user_type == AGENT ? 'agent' : 'renter'))->loginUsingId($user->id);
            }
        }

        return false;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function validateRememberToken($token) {
        $user = $this->userRepo->find(['remember_token' => $token])->first();
        return $user ? $user : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function addExclusiveSettings($id) {
        return $this->exclusiveSettingRepo->create(['user_id' => $id]);
    }

    /**
     * @param $request
     * @return bool
     */
    public function createUserByAdmin($request) {
        DB::beginTransaction();
        $user = $this->__validateAddUserByAdminForm($request);
        if($user = $this->userRepo->create($user->toArray())) {
            $this->addExclusiveSettings($user->id);
            DispatchNotificationService::ADDUSERBYADMIN($user);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $request
     * @param $token
     * @return bool|mixed
     */
    public function changePassword($request, $token) {
        if($user = $this->validateRememberToken($token)) {
            $password = $this->__validateChangePasswordForm($request);
            return $this->userRepo->update($user->id, [
                'status'   => ACTIVE,
                'email_verified_at' => now(),
                'password' => bcrypt($password->password)
            ]);
        }

        return false;
    }

    /**
     * @param $keywords
     * @return mixed
     */
    public function searchByEmail($keywords) {
        return $this->userRepo->search($keywords)->first();
    }


    /**
     * @param $request
     *
     * @return mixed
     */
    public function update($id, $request) {
        $user = $this->__validateAddUserByAdminForm($request);
        return $this->userRepo->update($id, $user->toArray());
    }

    /**
     * @return mixed
     */
    public function agents() {
        return $this->userRepo->agents()->get();
    }

    /**
     * @return mixed
     */
    public function renters() {
        return $this->userRepo->renters()->get();
    }

    /**
     * @return mixed
     */
    public function owners() {
        return $this->userRepo->owners()->get();
    }

    /**
     * @return mixed
     */
    public function agentsWitPlan() {
        return $this->userRepo->agentsWitPlan()->get();
    }

    /**
     * @return mixed
     */
    public function companies() {
        return $this->companyRepo->companies()->get();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function isUniqueEmail($request) {
        if ($user = $this->userRepo->isUniqueEmail($request->email)) {
            if($user->company->company == MRG) {
                return 'true';
            }

            return 'false';
        }

        return 'true';
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function renterCheck($request) {
        $renter = $this->userRepo->find(['email' => $request->email])->first();
        if(isset($renter)){
            return $renter->user_type == 4 ? 'true' : 'false' ;
        }
        else {
            return 'false' ;
        }
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function isUniqueLicense($request) {
        if (!$this->userRepo->isUniqueLicense($request->license_number)) {
            return 'true';
        }
        return 'false';
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return $this->userRepo->edit($id)->first();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id) {
        return $this->userRepo->update($id, [
            'email_verified_at' => Null
        ]);
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function updateProfile($request)
    {
        $user = new EditProfileForm();
        $user->id = $request->id ?? myId();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->languages = $request->languages;
        $user->address = $request->address;
        $user->description = $request->description;
        $user->profile = $request->file('profile_image') ?? $request->old_profile;
        $user->validate();
        if ($request->hasFile('profile_image')) {
            $user->profile = $this->updateProfileImage($user->profile, myId(), $request->old_profile ?? '');
        }
        $exclusive = $this->exclusiveSettingRepo->find(['user_id' => myId()])->first();

        if ($exclusive) {
            if ($request->has('allow_web_notifications')) {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_web_notification' => 1]);
            } else {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_web_notification' => 0]);
            }

            if ($request->has('allow_email_notifications')) {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_email' => 1]);
            } else {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_email' => 0]);
            }

            if ($request->has('disable')) {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_web_notification' => 0, 'allow_email' => 0]);
            }
        } else {
            $exclusive = $this->exclusiveSettingRepo->create([
                'user_id' => $user->id,
            ]);

            if ($request->has('allow_web_notifications')) {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_web_notification' => 1]);
            } else {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_web_notification' => 0]);
            }

            if ($request->has('allow_email_notifications')) {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_email' => 1]);
            } else {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_email' => 0]);
            }

            if ($request->has('disable')) {
                $this->exclusiveSettingRepo->update($exclusive->id, ['allow_web_notification' => 0, 'allow_email' => 0]);
            }

        }

        $old = [];
        $old = $this->getNeighborhoods(myId());
        $old_neighborhoods = [];

        for ($i = 0; $i < sizeof($old); $i++) {

            $old_neighborhoods[$i] = $this->neighborhoodRepo->find(['name' => $old[$i]])->first()->id;

        }

        $this->neighborhoodRepo->detach($this->userRepo->edit($user->id)->first(), $old_neighborhoods);

        $myArray = explode(',', $request->neighborhood_expertise);
        $neighborhoods = [];

        for ($i = 0; $i < sizeof($myArray) && sizeof($myArray) > 1; $i++) {

            $neighborhoods[$i] = $this->neighborhoodRepo->find(['name' => $myArray[$i]])->first()->id;

        }

        $this->neighborhoodRepo->attach($this->userRepo->edit($user->id)->first(), $neighborhoods);
        return $this->userRepo->update($user->id, $user->toArray());
    }

    /**
     * @param $profile_image
     * @param $id
     * @param null $old_image
     *
     * @return mixed
     */
    public function updateProfileImage($profile_image, $id, $old_image = null) {
        $destinationPath = 'images/users/profile';
        return uploadImage($profile_image, $destinationPath, true, $old_image);
    }

    /**
     * @param $clause
     *
     * @return mixed
     */
    public function first($clause) {
        return $this->userRepo->find($clause);
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function getAgentToken($token) {
        return $this->agentRepo->find(['token' => $token]);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function addMember($request) {
        $UserRes = $this->userRepo->find(['email' => $request->email])->first() ;
        $this->memberRepo->create([
            'agent_id' => $request->invited_by,
            'member_id' => $UserRes->id
        ]);
        return true;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function associatedAgents($id) {
        return $this->userRepo->find(['company_id' => $id])->withcompany()->get();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getExclusiveSettings($id) {
        return $this->exclusiveSettingRepo->find(['user_id'=> $id])->first();
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function getNeighborhoods($id) {
        $user = $this->userRepo->profileDetail($id)->get();
        $neighborhoods = [] ;

        for($i = 0 ; $i < sizeof($user[0]->neighborExpertise); $i++) {
           $neighborhoods[$i] =  $user[0]->neighborExpertise[$i]->name ;
        };

        return $neighborhoods;
    }

    /**
     * @param $listing_id
     *
     * @return bool
     */
    public function favourite($listing_id) {
        $this->userRepo->attach($this->userRepo->edit(myid())->first(), $listing_id);
        return true ;

    }

    /**
     * @param $listing_id
     *
     * @return bool
     */
    public function removeFavourite($listing_id) {

        $this->userRepo->detach($this->userRepo->edit(myid())->first(), $listing_id);
        return true ;

    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function status($id) {
        $user = $this->userRepo->edit($id);
        $status = $user->first();
        $update = $status->status !== 1;
        $user->update(['status' => $update]);
        return $update;
    }

    /**
     * @return array
     */
    public function getRenters() {
        $renters_email = [];
        $data = $this->userRepo->find(['user_type' => RENTER])->get();
        foreach ($data as $key=> $renter){
            array_push($renters_email, $renter->email);
        }
        return $renters_email;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id) {
        return $this->userRepo->findById($id)->first();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email) {
        return $this->userRepo->find(['email' => $email])->first();
    }

    /**
     * @return mixed
     */
    public function agentsWithMRGCompany() {
        return $this->userRepo->mrgAgents()->count() > 0 ? true : false;
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
     * @return SignUpForm
     */
    private function __validateDirectSignUpForm($request) {
        $form = new SignUpForm();
        $form->firstName      = $request->first_name;
        $form->lastName       = $request->last_name;
        $form->email          = $request->email;
        $form->phoneNumber    = $request->phone_number;
        $form->password       = bcrypt($request->password);
        $form->license        = $request->license_number;
        $form->userType       = $request->user_type;
        $form->company        = $this->__manageCompany($request);
        $form->remember_token = str_random(60);
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

    /**
     * @param $request
     * @return ChangePasswordForm
     */
    private function __validateChangePasswordForm($request) {
        $form = new ChangePasswordForm();
        $form->id = $request->id;
        $form->password = $request->password;
        $form->password_confirmation = $request->password_confirmation;
        $form->validate();

        return $form;
    }

    /**
     * @param $request
     * @return CreateUserByAdminForm
     */
    private function __validateAddUserByAdminForm($request) {
        $form = new CreateUserByAdminForm();
        $form->firstName      = $request->first_name;
        $form->lastName       = $request->last_name;
        $form->email          = $request->email;
        $form->phoneNumber    = $request->phone_number;
        $form->userType       = $request->user_type;
        $form->rememberToken  = str_random(60);
        $form->validate();

        return $form;
    }
}
