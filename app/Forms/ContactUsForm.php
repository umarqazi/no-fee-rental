<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/4/20
 * Time: 10:13 PM
 */

namespace App\Forms;

/**
 * Class ContactUsForm
 * @package App\Forms
 */
class ContactUsForm extends BaseForm {

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone_number;

    /**
     * @var string
     */
    public $message;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'email'        => $this->email,
            'username'     => $this->username,
            'message'      => $this->message,
            'phone_number' => $this->phone_number,
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'email'        => 'required|email',
            'username'     => 'required|string',
            'message'      => 'required|max:500',
            'phone_number' => 'required|string',
        ];
    }
}