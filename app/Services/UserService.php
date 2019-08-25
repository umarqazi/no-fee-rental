<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\Agent\CreateForm;
use App\Forms\User\AgentInvitationForm;
use App\Forms\User\ChangePasswordForm;
use App\Forms\User\EditProfileForm;
use App\Forms\User\UserForm;
use App\Repository\CompanyRepo;
use App\Repository\MemberRepo;
use App\Repository\AgentRepo;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\DB;

class UserService {

    /**
     * @var UserRepo
     */
    private $repo;

    /**
     * UserService constructor.
     *
     * @param UserRepo $repo
     */
    public function __construct(UserRepo $repo) {
        $this->repo = $repo;
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
     * @param $id
     *
     * @return int
     */
    public function status($id) {
        return $this->repo->status($id);
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
        $response = $this->repo->create($user->toArray());
        if (!empty($response)) {
            $email = [
                'first_name' => $user->first_name,
                'subject'    => 'Account Created',
                'view'       => 'create-user',
                'link'       => route('user.change_password', base64_encode($user->email)),
            ];
            mailService($user->email, toObject($email));
            return $response;
        }
        return false;
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function update($id, $request) {
        $user = $this->form($request);
        return $this->repo->update($user->id, $user->toArray());
    }

    /**
     * @return mixed
     */
    public function agents() {
        return $this->repo->agents()->get();
    }

    /**
     * @return mixed
     */
    public function renters() {
        return $this->repo->renters()->get();
    }

    /**
     * @return mixed
     */
    public function companies() {
        $this->repo = new CompanyRepo();
        return $this->repo->companies()->get();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function isUniqueEmail($request) {
        $this->repo = new AgentRepo;
        if (!$this->repo->isUniqueEmail($request->email)) {
            $this->repo = new UserRepo;
            if (!$this->repo->isUniqueEmail($request->email)) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function edit($id) {
        return $this->repo->edit($id)->first();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    public function delete($id) {
        return $this->repo->delete($id);
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
        $user->profile = $request->file('profile_image') ?? $request->old_profile;
        $user->validate();
        if ($request->hasFile('profile_image')) {
            $user->profile = $this->updateProfileImage($user->profile, myId(), $request->old_profile ?? '');
        }
        return $this->repo->update($user->id, $user->toArray());
    }

    /**
     * @param $profile_image
     * @param $id
     * @param null $old_image
     *
     * @return mixed
     */
    public function updateProfileImage($profile_image, $id, $old_image = null) {
        $destinationPath = 'data/' . $id . '/profile_image';
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
            'subject' => 'Invitation By ' . mySelf()->email,
            'link'    => route('agent.signup_form', $agent->token),
        ];

        return mailService($agent->email, toObject($email));
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function sendInvite($request) {
        $this->repo = new AgentRepo;
        $agent = new AgentInvitationForm();
        $agent->invite_by = myId();
        $agent->email = $request->email;
        $agent->token = str_random(60);
        if ($agent->fails()) {
            if($res = $this->repo->find(['email' => $request->email])->first()) {
                $this->repo->update($res->id, ['token' => $agent->token]);
                $this->agentMail($agent);
                return true;
            }
            return $agent->validate();
        }
        $this->repo->invite($agent->toArray());
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
        return $this->repo->update($form->id, [
            'email_verified_at' => now(),
            'password'          => bcrypt($form->password)
        ]);
    }

    /**
     * @param $clause
     *
     * @return mixed
     */
    public function first($clause) {
        return $this->repo->find($clause);
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
        $form->password_confirmation = $request->password_confirmation;
        $form->validate();

        DB::beginTransaction();
        $form->password = bcrypt($form->password);
        $user = $this->repo->create($form->toArray());
        if ($user && $sendMail) {
            $data = [
                'view'       => 'signup',
                'subject'    => 'Verify Email',
                'first_name' => $user->first_name,
                'link'       => route('user.confirmEmail', base64_encode($user->email)),
            ];
            mailService($user->email, toObject($data));
            DB::commit();
            return true;
        } else if ($user) {
            $this->repo = new AgentRepo();
            $requestedAgentId = $this->repo->find(['token' => $request->token])->first();
            $this->repo = new MemberRepo();
            $this->repo->create(['agent_id' => $requestedAgentId->invited_by, 'member_id' => $user->id]);
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
        $record = $this->repo->find(['email' => base64_decode($token)])->first();
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
            $this->repo->update($res->id, ['email_verified_at' => now()]);
            return true;
        }

        return false;
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function isInvitedAgent($token) {
        $this->repo = new AgentRepo();
        return $this->repo->find(['token' => $token]);
    }

    /**
     * @return mixed
     */
    public function getMembers() {
        return $this->repo->get();
    }
}