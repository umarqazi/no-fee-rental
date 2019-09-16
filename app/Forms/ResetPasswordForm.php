<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Forms;


class ResetPasswordForm extends BaseForm {

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $token;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'created_at' => now(),
            'email'      => $this->email,
            'token'      => $this->token
        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'email' => 'required|email'
        ];
    }
}
