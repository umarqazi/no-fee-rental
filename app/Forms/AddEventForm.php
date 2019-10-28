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
     * @var integer
     */
    public $from;

    /**
     * @var integer
     */
    public $to;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $linked_id;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'title'      => $this->title,
            'start'      => $this->start,
            'end'        => $this->end,
            'color'      => $this->color,
            'url'        => $this->url,
            'from'       => $this->from,
            'to'         => $this->to,
            'linked_id'  => $this->linked_id
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
