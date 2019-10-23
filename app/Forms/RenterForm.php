<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

/**
 * Class RenterForm
 * @package App\Forms
 */
class RenterForm extends BaseForm {

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
     * @return array
     */
    public function toArray() {
        return [
            'first_name'     => $this->firstName,
            'last_name'      => $this->lastName,
            'email'          => $this->email,
            'phone_number'   => $this->phoneNumber,
            'password'       => $this->password,
            'user_type'      => $this->userType
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
            'password'       => 'required|min:9|confirmed',
        ];
    }
}
