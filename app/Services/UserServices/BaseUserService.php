<?php

namespace App\Services\UserServices;

use App\Forms\User\AgentInvitationForm;
use App\Forms\User\ChangePasswordForm;
use App\Forms\User\EditProfileForm;
use App\Repository\User\AgentRepo;
use App\Services\RolesService;

class BaseUserService extends RolesService {

	/**
	 * @var Repo Instance
	 */
	protected $repo;

	/**
	 * BaseUserService constructor.
	 *
	 * @param $repo
	 */
	public function __construct($repo) {
		parent::__construct();
		$this->repo = $repo;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */
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
		$user->validate();
        if ($request->hasFile('profile_image')) {
            $this->updateProfileImage($request->file('profile_image'), myId(), $request->old_profile ?? '');
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
		$image_name = uploadImage($profile_image, $destinationPath, true, $old_image);
		return $this->repo->update($id, ['profile_image' => $image_name]);
	}

    /**
     * @param $agent
     *
     * @return mixed
     */
	private function agentMail($agent) {
        $email = [
            'view' => 'agent-invitation',
            'from' => mySelf()->email,
            'subject' => 'Invitation By ' . mySelf()->email,
            'link' => route('agent.signup_form', $agent->token),
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
		$change_password = new ChangePasswordForm();
		$change_password->id = $request->id ?? myId();
		$change_password->password = $request->password;
		$change_password->password_confirmation = $request->password_confirmation;
		$change_password->validate();
		return $this->repo->update($change_password->id, ['password' => bcrypt($change_password->password)]);
	}

	/**
	 * @return array
	 */
	public function roles() {
		return $this->fetch();
	}

	/**
	 * @param $clause
	 *
	 * @return mixed
	 */
	public function first($clause) {
		return $this->repo->find($clause);
	}
}
