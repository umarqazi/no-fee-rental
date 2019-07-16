<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServices\ClientService;

class UserController extends Controller {

	/**
	 * @var BaseUserService
	 */
	private $service;

	/**
	 * UserController constructor.
	 *
	 * @param BaseUserService $service
	 */
	public function __construct(ClientService $service) {
		$this->service = $service;
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function editProfile(Request $request) {
		$update_data = $this->service->update_profile($request);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->service->update_profile_image($request->file('profile_image'), myId(), $request->old_profile ?? null);
		}

		return $update_data
			? success('Profile has been updated successfully')
			: error('Something went wrong');
	}

	/**
	 * @param $token
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function changePassword($token) {
		return view('change-password', compact('token'));
	}

	/**
	 * @param Request $request
	 * @param $token
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updatePassword(Request $request, $token) {
		$user = $this->service->first(['email' => base64_decode($token)])->first();
		$request->id = $user->id;
		return $this->service->change_password($request)
			? success('Password has been updated')
			: error('Something went wrong');

	}

	/**
	 * @param Agent $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function agentSignup(Request $request) {
		return $this->service->agent_signup($request)
			? success( 'Account has been created' )
			: error( 'Something went wrong' );
	}
}