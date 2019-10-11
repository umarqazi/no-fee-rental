<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

class CheckAvailabilityForm extends BaseForm {

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
     * @var integer
     */
    public $listing_id;

    /**
     * @var integer
     */
    public $to;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'to'           => $this->to,
            'username'     => $this->username,
            'email'        => $this->email,
            'phone_number' => $this->phone_number,
            'listing_id'   => $this->listing_id,
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'listing_id'    => 'required',
            'username'      => 'required',
            'email'         => 'required|email',
            'phone_number'  => 'required',
            'to'            => 'required'
        ];
    }
}