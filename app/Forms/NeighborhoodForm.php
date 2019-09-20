<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

class NeighborhoodForm extends BaseForm {

    /**
     * @var string
     */
    public $content;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'content' => $this->content
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'content' => 'required'
        ];
    }
}
