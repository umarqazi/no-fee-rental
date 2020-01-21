<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

class EventForm extends BaseForm {

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
    public $url;

    /**
     * @var string
     */
    public $model;

    /**
     * @var string
     */
    public $ref_event_id;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'title'         => $this->title,
            'start'         => $this->start,
            'end'           => $this->end,
            'url'           => $this->url,
            'from'          => $this->from,
            'model'         => $this->model,
            'to'            => $this->to,
            'ref_event_id'  => $this->ref_event_id
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'model' => 'required',
            'title' => 'required',
            'start' => 'required',
            'end'   => 'required',
        ];
    }
}
