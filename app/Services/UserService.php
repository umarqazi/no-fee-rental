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
use App\Repository\CompanyRepo;
use App\Repository\MemberRepo;
use App\Repository\AgentRepo;
use App\Repository\UserRepo;
use App\User;
use Illuminate\Support\Facades\DB;

class UserService {

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
     * @var mixed
     */
    private $query;

    /**
     * UserService constructor.
     */
    public function __construct() {
        $this->userRepo = new UserRepo();
        $this->companyRepo = new CompanyRepo();
        $this->agentRepo = new AgentRepo();
        $this->memberRepo = new MemberRepo();
        $this->query = $this->userRepo->appendQuery();
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
        $response = $this->userRepo->create($user->toArray());
        if (!empty($response)) {

            $email = [
                'view'       => 'create-user',
                'first_name' =>  $response->first_name,
                'to'         =>  $response->email,
                'subject'    => 'Account Created',
                'link'       =>  route('user.change_password', $user->remember_token),       ];

            dispatchEmailQueue($email);
            return $response;
        }
        return false;
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
    public function updateProfile($request) {
        $user = new EditProfileForm();
        $user->id = $request->id ?? myId();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->neighbourhood_expertise = $request->neighbourhood_expertise;
        $user->languages = $request->languages;
        $user->address = $request->address;
        $user->description = $request->description;
        $user->profile = $request->file('profile_image') ?? $request->old_profile;
        $user->validate();
        if ($request->hasFile('profile_image')) {
            $user->profile = $this->updateProfileImage($user->profile, myId(), $request->old_profile ?? '');
        }
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
     *
     * @return mixed
     */
    private function agentMail($agent) {
        $email = [
            'view'    => 'agent-invitation',
            'from'    => mySelf()->email,
            'to'      => $agent->email,
            'subject' => 'Invitation By ' . mySelf()->email,
            'link'    => route('agent.signup_form', $agent->token),
        ];

        return dispatchEmailQueue($email);
    }

    /**
     * @param $agent
     *
     * @return mixed
     */
    private function memberMail($agent) {
        $email = [
            'view'    => 'member-invitation',
            'from'    => mySelf()->email,
            'to'      => $agent->email,
            'subject' => 'Invitation By ' . mySelf()->email,
            'link'    => route('agent.acceptInvitation', $agent->token),
        ];

        return dispatchEmailQueue($email);
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
                    $this->memberMail($agent);
                    $this->agentRepo->update($InviteRes->id, ['token' => $agent->token]);
                    return true ;
                }
                $this->agentRepo->update($InviteRes->id, ['token' => $agent->token]);
                $this->agentMail($agent);
                return true;
            }

            return $agent->validate();
        }
        $this->agentRepo->invite($agent->toArray());
        $this->agentMail($agent);
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
            $data = [
                'view'       => 'signup',
                'to'         =>  $user->email,
                'first_name' =>  $user->first_name,
                'subject'    => 'Verify Email',
                'link'       =>  route('user.confirmEmail', $user->remember_token),
            ];

            dispatchEmailQueue($data);
            DB::commit();
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
            'agent_id' => mySelf()->id,
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
        return [
            'agent'    => $data,
            'listings' => $data->listings
        ];
    }

    /**
     * @param $id
     */
    public function cheaper($id) {
        $this->query = $this->userRepo->cheaper($id);
    }

    /**
     * @param $id
     */
    public function recent($id) {
        $this->query = $this->userRepo->recent($id);
    }

    /**
     * fetch Query
     */
    public function fetchQuery() {
        $data = $this->query->first();
        return [
            'agent'    => $data,
            'listings' => $data->listings
        ];
    }
}
