<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Forms;


use Illuminate\Support\Facades\Validator;

class AppointmentForm extends BaseForm {

    /**
     * @var string
     */
    public $first_name;

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
    public $appointment_at;

    /**
     * @var integer
     */
    public $from;

    /**
     * @var integer
     */
    public $to;

    /**
     * @var string
     */
    public $message;

    /**
     * @var integer
     */
    public $listing_id;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'listing_id'     => $this->listing_id,
            'from'           => $this->from,
            'to'             => $this->to,
            'appointment_at' => $this->appointment_at
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'listing_id'     => 'required|integer',
            'from'           => 'required|integer',
            'to'             => 'required|integer',
            'appointment_at' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function newRequestArray() {
        return [
            'first_name'   => $this->first_name,
            'email'        => $this->email,
            'phone_number' => $this->phone_number
        ];
    }

    /**
     * @return array
     */
    public function newRequestRules() {
        return [
            'first_name'   => 'required|string',
            'email'        => 'required|email|unique:users',
            'phone_number' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function newRequestValidate() {
        return Validator::make($this->newRequestArray(), $this->newRequestRules())->validate();
    }
}
