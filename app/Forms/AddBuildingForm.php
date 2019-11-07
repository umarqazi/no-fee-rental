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
    public $neighborhood;

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
     * @return array
     */
    public function toArray() {
        return [
            'user_id'                => $this->user_id,
            'building'               => str_random(10),
            'address'                => $this->address,
            'neighborhood'           => $this->neighborhood,
            'building_action'        => $this->building_action,
            'is_verified'            => isOwner() ? ACTIVE : DEACTIVE,
            'contact_representative' => $this->contact_representative,
        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            'address'         => 'required',
            'neighborhood'    => 'required',
            'building_action' => 'required',
        ];
    }
}
