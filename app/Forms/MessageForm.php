<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Forms;

class MessageForm extends BaseForm {

    /**
     * @var string
     */
    public $message;

    /**
     * @var integer
     */
    public $contact_id;

    /**
     * @var integer
     */
    public $align;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'message'    => $this->message,
            'contact_id' => $this->contact_id,
            'align'      => $this->align
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'message'    => 'required',
            'contact_id' => 'required',
            'align'      => 'required'
        ];
    }
}
