<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Forms;

class MessageForm extends BaseForm {

    public $message;

    public $contact_id;

    public $align;

    public function toArray() {
        return [
            'message' => $this->message,
            'contact_id' => $this->contact_id,
            'align' => $this->align
        ];
    }

    public function rules() {
        return [
            'message' => 'required',
            'contact_id' => 'required',
            'align' => 'required'
        ];
    }
}
