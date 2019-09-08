<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

class NotificationForm extends BaseForm {

    public $from;
    public $to;
    public $path;
    public $notification;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'from' => $this->from,
            'to' => $this->to,
            'path' => $this->path,
            'notification' => $this->notification
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'from' => 'required|integer',
            'to' => 'required|integer',
            'path' => 'required',
            'notification' => 'required'
        ];
    }
}
