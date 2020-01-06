<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

/**
 * Class NotificationForm
 * @package App\Forms
 */
class NotificationForm extends BaseForm {

    /**
     * @var integer
     */
    public $to;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $message;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'to'      => $this->to,
            'url'     => $this->url,
            'message' => $this->message,
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'to' => 'required',
        ];
    }
}
