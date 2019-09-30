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
    public $name;

    /**
     * @var string
     */
    public $content;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'name' => $this->name,
            'content' => $this->content
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'name' => 'required'
        ];
    }
}
