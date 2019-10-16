<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

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
     * @var integer
     */
    public $conversation_type;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'listing_id'        => $this->listing_id,
            'from'              => $this->from,
            'to'                => $this->to,
            'conversation_type' => $this->conversation_type,
            'appointment_date'  => $this->appointment_date,
            'appointment_time'  => $this->appointment_time
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
