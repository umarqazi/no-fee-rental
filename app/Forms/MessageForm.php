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
    public $conversation_id;

    /**
     * @var integer
     */
    public $align;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'message'         => $this->message,
            'conversation_id' => $this->conversation_id,
            'align'           => $this->align
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'message'   => 'required'
        ];
    }
}
