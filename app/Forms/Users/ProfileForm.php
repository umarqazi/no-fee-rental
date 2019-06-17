<?php
/**
 * Created by PhpStorm.
 * User: adi
 * Date: 6/15/19
 * Time: 4:11 PM
 */

namespace App\Forms\Users;

use App\Forms\BaseForm;
use Illuminate\Validation\Rule;

class ProfileForm extends BaseForm
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $profile_image;
    public $user_id;

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return[
            'user_id'       => $this->user_id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'phone_number'  => $this->phone_number,
            'email'         => $this->email,
            'profile_image' => $this->profile_image,
        ];
    }

    /**
     * @return mixed
     */
    public function rules()
    {
        return [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($this->user_id),
            ],
            'phone_number'  => 'required|max:16',
            'profile_image' => 'nullable|mimes:jpeg,png,jpg,gif',
        ];
    }
}