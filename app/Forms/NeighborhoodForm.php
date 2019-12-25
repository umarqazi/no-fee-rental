<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

/**
 * Class NeighborhoodForm
 * @package App\Forms
 */
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
     * @var int
     */
    public $boro_id;

    /**
     * @var string
     */
    public $banner;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'name' => $this->name,
            'content' => $this->content,
            'banner' => $this->banner,
            'boro_id' => $this->boro_id
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'name' => 'required',
            'boro_id' => 'required'
        ];
    }
}
