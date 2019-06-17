<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 3:57 PM
 */

namespace App\Http\Controllers;


use App\Forms\Users\ChangePasswordForm;
use App\Forms\Users\ProfileForm;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\User;
use App\Services\UserServices;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user_service;

    protected $user_id;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user_service =   new UserServices();
    }

    /**
     * @param User $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editProfile(Request $request){
        $form           =   new ProfileForm();
        $form->user_id  =   $request->id;
        $form->first_name=$request->first_name;
        $form->last_name=$request->last_name;
        $form->email=$request->email;
        $form->phone_number=$request->phone_number;
        $form->profile_image=$request->profile_image;
        $update_data    =   $this->user_service->updateAdminProfile($form);
        if ($request->hasFile('profile_image')) {
            $update_data    =   $this->user_service->updateProfileImage($request->file('profile_image'), $form);
        }
        $notification   =   [
            'message'   =>  'ProfileForm has been updated successfully',
            'alert_type'      =>  'success'
        ];

        return Redirect::back()->with($notification);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function changePassword(){
        return view::make('change-password');
    }

    /**
     * @param ChangePassword $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request){
        $change_password            =   new ChangePasswordForm();
        $change_password->password  =   $request->password;
        $change_password->password_confirmation  =   $request->password_confirmation;
        $change_password->user_id  =   Auth::user()->id;
        $this->user_service->changePassword($change_password);
        $notification   =   [
            'message'   =>  'Password has been updated successfully',
            'alert_type'      =>  'success'
        ];

        return Redirect::to(route('profile'))->with($notification);

    }
}