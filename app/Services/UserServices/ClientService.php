<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services\UserServices;

use App\Repository\User\UserRepo;
use App\Forms\Agent\CreateAgentForm;

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
	public function agent_signup($request) {
		$form = new CreateAgentForm();
		$form->first_name = $request->first_name;
		$form->last_name = $request->last_name;
		$form->email = $request->email;
		$form->phone_number = $request->phone_number;
		$form->user_type = $request->user_type;
		$form->password = $request->password;
		$form->password_confirmation = $request->password_confirmation;
		$form->validate();
		$form->password = bcrypt($form->password);
		return $this->repo->create($form->toArray());
	}
}