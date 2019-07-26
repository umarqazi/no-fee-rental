<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services\UserServices;

use App\Forms\Agent\CreateAgentForm;
use App\Repository\User\UserRepo;
use DB;

class ClientService extends BaseUserService {

	/**
	 * ClientService constructor.
	 */
	public function __construct() {
		parent::__construct(new UserRepo);
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
		$form = new CreateAgentForm();
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
				'view' => 'signup',
				'subject' => 'Verify Email',
				'first_name' => $user->first_name,
				'link' => route('user.confirmEmail', base64_encode($user->email)),
			];
			mailService($user->email, toObject($data));
			DB::commit();
			return true;
		} else if ($user) {
			DB::commit();
			return true;
		}

		return false;
	}

	/**
	 * @param $token
	 *
	 * @return bool
	 */
	public function validateEncodedToken($token) {
		$record = $this->repo->first(['email' => base64_decode($token)])->first();
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
}
