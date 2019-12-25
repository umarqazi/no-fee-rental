<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\Agent\CreateForm;
use App\Forms\CompanyForm;
use App\Forms\User\AgentInvitationForm;
use App\Forms\User\ChangePasswordForm;
use App\Forms\User\EditProfileForm;
use App\Forms\User\UserForm;
use App\Listing;
use App\Repository\CompanyRepo;
use App\Repository\ExclusiveSettingRepo;
use App\Repository\MemberRepo;
use App\Repository\AgentRepo;
use App\Repository\NeighborhoodRepo;
use App\Repository\UserRepo;
use App\Traits\DispatchNotificationService;
use App\Traits\SearchTraitService;
use App\User;
use Illuminate\Support\Facades\DB;
use Zend\Diactoros\Request;

class UserService {

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
     * @var MemberRepo
     */
    private $memberRepo;

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
        $this->userRepo = new UserRepo();
        $this->companyRepo = new CompanyRepo();
        $this->agentRepo = new AgentRepo();
        $this->memberRepo = new MemberRepo();
        $this->neighborhoodRepo = new NeighborhoodRepo();
        $this->exclusiveSettingRepo = new ExclusiveSettingRepo();
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function get($paginate) {
        return $this->collection($paginate);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function collection($paginate) {
        $agents = $this->agents()->paginate($paginate, ['*'], 'agents');
        $renters = $this->renters()->paginate($paginate, ['*'], 'renters');

        return compact('agents', 'renters');
    }

    /**
     * @param $request
     *
     * @return UserForm
     */
    private function form($request) {
        $user = new UserForm();
        $user->id = $request->id ?? myId();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->user_type = $request->user_type;
        $user->remember_token = str_random(60);
        $user->validate();
        return $user;
    }

    /**
     * @param $request
     *
     * @return bool|mixed
     */
    public function create($request) {
        $user = $this->form($request);

            if ($request->user_type == AGENT) {
                $agent = new AgentInvitationForm();
                $agent->invite_by = myId();
                $agent->email = $request->email;
                $agent->token = str_random(60);
                $agent->accept = NULL;
                $this->agentRepo->invite($agent->toArray());
                $this->agentMail($agent);
                return true;

            } else {
                $response = $this->userRepo->create($user->toArray());
                $this->exclusiveSettingRepo->create([
                    'user_id' => $response->id,
                ]);

                DispatchNotificationService::ADDUSERBYADMIN(toObject([
                    'to' => $response->id,
                    'from' => myId(),
                    'data' => $response
                ]));
                return $response;
            }

    }


    /**
     * @param $request
     *
     * @return mixed
     */
    public function update($id, $request) {
        $user = $this->form($request);
        return $this->userRepo->update($user->id, $user->toArray());
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
        if (!$this->agentRepo->isUniqueEmail($request->email)) {
            if (!$this->userRepo->isUniqueEmail($request->email)) {
                return 'true';
            }

            return 'false';
        }

        return 'false';
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
        return $this->userRepo->delete($id);
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
        $destinationPath = 'storage/data/' . $id . '/profile_image';
        return uploadImage($profile_image, $destinationPath, true, $old_image);
    }

    /**
     * @param $agent
     */
    private function agentMail($agent) {
        DispatchNotificationService::AGENTINVITE(toObject([
            'from' => myId(),
            'to'   => $agent->email,
            'data' => $agent,
            'is_invite' => true
        ]));
    }

    /**
     * @param $agent
     * @param $user
     */
    private function memberMail($agent, $user) {
        DispatchNotificationService::ADDMEMBER(toObject([
            'from' => myId(),
            'to'   => $user->id,
            'data' => $agent
        ]));
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function sendInvite($request) {
        $agent = new AgentInvitationForm();
        $agent->invite_by = myId();
        $agent->email = $request->email;
        $agent->token = str_random(60);
        if(isAdmin()) {
            $agent->accept = NULL;
        }
        else {
            $agent->accept = 0 ;
        }
        if ($agent->fails()) {
            if($InviteRes = $this->agentRepo->find(['email' => $request->email])->first()) {
                if($UserRes = $this->userRepo->find(['email' => $request->email])->first()) {
                    $this->memberMail($agent, $UserRes);
                    $this->agentRepo->update($InviteRes->id, ['token' => $agent->token]);
                    return true ;
                }
                $this->agentRepo->update($InviteRes->id, ['token' => $agent->token]);
                $InviteRes = $this->agentRepo->find(['email' => $request->email])->first();
                $this->agentMail($InviteRes);
                return true;
            }

            return $agent->validate();
        }
        if($UserRes = $this->userRepo->find(['email' => $request->email])->first()) {
            $this->memberMail($agent, $UserRes);
            $this->agentRepo->invite($agent->toArray());
            return true ;
        }
        $inviteRes = $this->agentRepo->invite($agent->toArray());
        $this->agentMail($inviteRes);
        return true;
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function changePassword($request) {
        $form = new ChangePasswordForm();
        $form->id = $request->id ?? myId();
        $form->password = $request->password;
        $form->password_confirmation = $request->password_confirmation;
        $form->validate();
        return $this->userRepo->update($form->id, ['password' => bcrypt($form->password)]);
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
     * @param $request
     *
     * @return mixed
     */
    public function invitedAgentSignup($request) {
        return $this->signup($request, false);
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function renterSignup($request){
        $form = new CreateForm();
        $form->first_name = $request->first_name;
        $form->last_name = $request->last_name;
        $form->email = $request->email;
        $form->phone_number = $request->phone_number;
        $form->user_type = $request->user_type;
        $form->password = $request->password;
        $form->license_number = $request->license_number;
        $form->address = $request->address;
        $form->password_confirmation = $request->password_confirmation;
        $form->remember_token = str_random(60);
        $form->validate();
        $form->password = bcrypt($form->password);
        $user = $this->userRepo->create($form->toArray());

        DispatchNotificationService::USERSIGNUP(toObject([
            'to'   =>  $user->id,
            'from' => mailToAdmin(),
            'data' => $user
        ]));
        return true ;
    }

        /**
     * @param $request
     * @param bool $sendMail
     *
     * @return bool
     */
    public function signup($request, $sendMail = true) {
        $form = new CreateForm();
        $form->first_name = $request->first_name;
        $form->last_name = $request->last_name;
        $form->email = $request->email;
        $form->phone_number = $request->phone_number;
        $form->user_type = $request->user_type;
        $form->password = $request->password;
        $form->license_number = $request->license_number;
        $form->address = $request->address;
        $form->password_confirmation = $request->password_confirmation;
        $form->remember_token = str_random(60);
        $form->validate();

        DB::beginTransaction();
        $form->password = bcrypt($form->password);
        $user = $this->userRepo->create($form->toArray());
        if ($user && $sendMail) {
            $cForm = new CompanyForm();
            $cForm->company = $request->company;
            if (!$cForm->fails()) {
                $company= $this->companyRepo->create($cForm->toArray());
                $this->userRepo->update($user->id,['company_id' => $company->id]);
            }
            else {
                $company= $this->companyRepo->find(['company' => $request->company])->first();
                $this->userRepo->update($user->id,['company_id' => $company->id]);
            }

            DB::commit();
            DispatchNotificationService::USERSIGNUP(toObject([
                'to'   =>  $user->id,
                'from' => mailToAdmin(),
                'data' => $user
            ]));

            $this->exclusiveSettingRepo->create([
                'user_id' => $user->id,
            ]);

            return true;
        }

        if ($user) {
            $cForm = new CompanyForm();
            $cForm->company = $request->company;

            if (!$cForm->fails()) {
                $company= $this->companyRepo->create($cForm->toArray());
                $this->userRepo->update($user->id,['company_id' => $company->id]);
            }
            else {
                $company= $this->companyRepo->find(['company' => $request->company])->first();
                $this->userRepo->update($user->id,['company_id' => $company->id]);
            }
            $invitedBy = $this->agentRepo->inviteBy($request->token);
            if($invitedBy->user->user_type == AGENT) {
                $this->memberRepo->create([
                    'agent_id' => $invitedBy->invited_by,
                    'member_id' => $user->id
                ]);
            }

            DispatchNotificationService::USERSIGNUP(toObject([
                'to'   =>  $user->id,
                'from' => mailToAdmin(),
                'data' => $user
            ]));

            $this->exclusiveSettingRepo->create([
                'user_id' => $user->id,
            ]);

            DB::commit();
            return true;
        }
        DB::rollback();
        return false;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function validateEncodedToken($token) {
        $record = $this->userRepo->find(['remember_token' => $token])->first();
        return $record ? $record : false;
    }

    /**
     * @param $token
     *
     * @return bool
     */
    public function verifyEmail($token) {
        $res = $this->validateEncodedToken($token);
        if ($res) {
            $this->userRepo->update($res->id, ['email_verified_at' => now()]);
            return true;
        }

        return false;
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
    public function getAgentWithListings($id) {
        $data = $this->userRepo->profileDetail($id)->first();
        return toObject([
            'agent'    => $data,
            'listings' => $data->listings,
            'reviews'  => $data->reviews
        ]);
    }

    /**
     * @param $id
     * @param $request
     * @return object
     */
    public function advanceSearch($id, $request) {
        $service = new SearchService();
        $request->agentProfile = $id;
        $data = collect($service->search($request));
        $info = $data->first();
        return toObject([
            'agent'    => $info->agent,
            'listings' => $data,
            'reviews'  => $info->agent->reviews
        ]);
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function unFriend($id) {
        return $this->memberRepo->delete($id);
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
}
