<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Forms;

/**
 * Class AddBuilding
 * @package App\Forms
 */
class AddBuildingForm extends BaseForm {

    /**
     * @var string
     */
    public $address;

    /**
     * @var int
     */
    public $neighborhood_id;

    /**
     * @var string
     */
    public $thumbnail;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int
     */
    public $contact_representative;

    /**
     * @var string
     */
    public $building_action;

    /**
     * @var string
     */
    public $map_location;

    /**
     * @var bool
     */
    public $is_verified;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'user_id'                => $this->user_id,
            'thumbnail'              => $this->thumbnail,
            'address'                => $this->address,
            'map_location'           => $this->map_location,
            'neighborhood_id'        => $this->neighborhood_id,
            'building_action'        => $this->building_action,
            'is_verified'            => $this->is_verified,
            'contact_representative' => $this->contact_representative,
        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'address'         => 'required',
            'thumbnail'       => 'required',
            'map_location'    => 'required',
            'neighborhood_id' => 'required',
            'building_action' => 'required',
        ];
    }
}
