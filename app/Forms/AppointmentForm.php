<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

use Illuminate\Support\Facades\Validator;

/**
 * Class AppointmentForm
 * @package App\Forms
 */
class AppointmentForm extends BaseForm {

    /**
     * @var string
     */
    public $appointment_date;

    /**
     * @var string
     */
    public $appointment_time;

    /**
     * @var string
     */
    public $message;

    /**
     * @var integer
     */
    public $from;

    /**
     * @var integer
     */
    public $to;

    /**
     * @var integer
     */
    public $listing_id;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'listing_id'       => $this->listing_id,
            'from'             => $this->from,
            'to'               => $this->to,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'listing_id'       => 'required|integer',
            'from'             => 'required|integer',
            'to'               => 'required|integer',
            'appointment_date' => 'required',
            'appointment_time' => 'required'
        ];
    }
}
