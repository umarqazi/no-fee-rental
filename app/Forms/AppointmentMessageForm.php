<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

/**
 * Class AppointmentMessageForm
 * @package App\Forms
 */
class AppointmentMessageForm extends BaseForm {

    /**
     * @var string
     */
    public $message;

    /**
     * @var integer
     */
    public $appointment_id;

    /**
     * @var integer
     */
    public $align;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'message'        => $this->message,
            'appointment_id' => $this->appointment_id,
            'align'          => $this->align
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'message'        => 'required',
            'appointment_id' => 'required',
            'align'          => 'required'
        ];
    }
}
