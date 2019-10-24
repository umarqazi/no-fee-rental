<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

class AddEventForm extends BaseForm {

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $start;

    /**
     * @var string
     */
    public $end;

    /**
     * @var string
     */
    public $user_id;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $url;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'title'     => $this->title,
            'start'     => $this->start,
            'end'       => $this->end,
            'color'     => $this->color,
            'url'       => $this->url,
            'user_id'   => $this->user_id
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'title' => 'required',
            'start' => 'required',
            'end'   => 'required',
        ];
    }
}
