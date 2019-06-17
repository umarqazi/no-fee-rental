<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/14/19
 * Time: 3:53 PM
 */

namespace App\Services;


use App\Forms\IForm;
use App\Repository\UserRepo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    protected $user_repo;

    /**
     * UserServices constructor.
     */
    public function __construct()
    {
        $this->user_repo    =   new UserRepo();
    }

    /**
     * @param $data
     * @return bool
     */
    public function updateAdminProfile(IForm $form){
        $form->validate();

        $user_detail['first_name']=$form->first_name;
        $user_detail['last_name']=$form->last_name;
        $user_detail['email']=$form->email;
        $user_detail['phone_number']=$form->phone_number;
        $user_id=['id'=>$form->user_id];
        return $this->user_repo->update($user_detail, $user_id);
    }

    /**
     * @param $profile_image
     * @param $form
     * @return bool
     */
    public function updateProfileImage($profile_image, $form){
        $destinationPath = 'data/'.$form->user_id.'/profile_image';
        $image_name     =   $this->uploadImage($profile_image, $destinationPath);
        $image_data     =   ['profile_image'=>$image_name];
        $user_id=['id'=>$form->user_id];
        return $this->user_repo->update($image_data, $user_id);
    }

    /**
     * @param $image_name
     * @param $destination
     * @return string
     */
    public function uploadImage($image_name, $destination){
        $name = time().'.'.$image_name->getClientOriginalExtension();
        if(!File::isDirectory($destination)){
            File::makeDirectory($destination, 0777, true, true);
        }
        Storage::disk('public')->putFileAs($destination, $image_name, $name);
        $full_image_name =  $destination.'/'.$name;
        return $full_image_name;
    }

    public function changePassword(IForm $form){
        $form->validate();
        $user_password  =   ['password'=>Hash::make($form->password)];
        $user_id=['id'=>$form->user_id];
        return $this->user_repo->update($user_password, $user_id);
    }
}