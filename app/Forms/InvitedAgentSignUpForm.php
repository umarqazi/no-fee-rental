<?php

namespace App\Forms;

use App\Forms\BaseForm;

/**
 * Class InvitedAgentSignUpForm
 * @package App\Forms\Agent
 */
class InvitedAgentSignUpForm extends BaseForm
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

    public $license_number;

    /**
     * @var string
     */
    public $company;

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
            'status'   => ACTIVE,
            'email_verified_at' => now(),
            'license_number' => $this->license_number,
            'company_id' => $this->company ?? null
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
            'email' => 'required|email',
            'license_number' => 'required',
            'phone_number' => 'required|max:16',
            'password' => 'required|string|min:8',
            'user_type' => 'required|integer',
        ];
    }
}
