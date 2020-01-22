<?php

namespace App\Forms\Agent;

use App\Forms\BaseForm;

class CreateForm extends BaseForm
{

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone_number;

    /**
     * @var integer
     */
    public $user_type;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $password_confirmation;

    /**
     * @var string
     */
    public $remember_token;

    /**
     * @var string
     */

    public $license_number;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $description;

    /**
     * Get the instance as an array.
     *
     * @return array
     */


    public function toArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'user_type' => $this->user_type,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'license_number' => $this->license_number,
            'remember_token' => $this->remember_token,
            'address' => $this->address,
        ];
    }

    /**
     * @return mixed
     */
    function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|max:16',
            'password' => 'required|string|confirmed|min:8',
            'user_type' => 'required|integer',
        ];
    }
}
