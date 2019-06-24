<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;

use App\Forms\User\ChangePasswordForm;
use App\Forms\User\UserForm;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UserController extends Controller {
	protected $user_service;

	protected $user_id;

	/**
	 * UserController constructor.
	 */
	public function __construct(UserServices $service) {
		$this->user_service = $service;
	}

	/**
	 * @param User $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function editProfile(Request $request) {
		$form = new UserForm($request);
		$update_data = $this->user_service->updateAdminProfile($form, $form->user);
		if ($request->hasFile('profile_image')) {
			$update_data = $this->user_service->updateProfileImage($request->file('profile_image'), $form->user);
		}
		$notification = [
			'message' => 'ProfileForm has been updated successfully',
			'alert_type' => 'success',
		];

		return Redirect::back()->with($notification);
	}

	/**
	 * @return \Illuminate\Contracts\View\View
	 */
	public function changePassword($token) {
		return view::make('change-password');
	}

	/**
	 * @param ChangePassword $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function updatePassword(Request $request) {
		$change_password = new ChangePasswordForm();
		$change_password->password = $request->password;
		$change_password->password_confirmation = $request->password_confirmation;
		$change_password->user_id = Auth::user()->id;
		$this->user_service->changePassword($change_password);
		$notification = [
			'message' => 'Password has been updated successfully',
			'alert_type' => 'success',
		];

		return Redirect::to(route('profile'))->with($notification);

	}
}