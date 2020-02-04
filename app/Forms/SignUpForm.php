<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

/**
 * Class AgentForm
 * @package App\Forms
 */
class SignUpForm extends BaseForm {

    /**
     * @var string
     */
    public $license;

    /**
     * @var string
     */
    public $company;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $phoneNumber;

    /**
     * @var integer
     */
    public $userType;

    /**
     * @var string
     */
    public $emailVerified;

    /**
     * @var string
     */
    public $remember_token;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'first_name'        => $this->firstName,
            'last_name'         => $this->lastName,
            'email'             => $this->email,
            'user_type'         => $this->userType,
            'phone_number'      => $this->phoneNumber,
            'password'          => $this->password,
            'company_id'        => $this->company,
            'license_number'    => $this->license,
            'email_verified_at' => $this->emailVerified,
            'remember_token'    => $this->remember_token
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|email',
            'phone_number'   => 'required',
            'user_type'      => 'required',
            'password'       => 'required|min:9',
        ];
    }
}
