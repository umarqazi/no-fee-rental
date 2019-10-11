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
class MessageForm extends BaseForm {

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
    public $check_availability_id;

    /**
     * @var integer
     */
    public $align;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'message'               => $this->message,
            'appointment_id'        => $this->appointment_id,
            'check_availability_id' => $this->check_availability_id,
            'align'                 => $this->align
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'message'        => 'required',
            'align'          => 'required'
        ];
    }
}
