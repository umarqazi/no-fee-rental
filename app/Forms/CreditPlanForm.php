<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Forms;

/**
 * Class CreditPlanForm
 * @package App\Forms
 */
class CreditPlanForm extends BaseForm {

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var int
     */
    public $remaining_slots;

    /**
     * @var int
     */
    public $remaining_repost;

    /**
     * @var int
     */
    public $remaining_featured;

    /**
     * @var boolean
     */
    public $is_expired;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'user_id'            => $this->user_id,
            'is_expired'         => $this->is_expired,
            'remaining_slots'    => $this->remaining_slots,
            'remaining_repost'   => $this->remaining_repost,
            'remaining_featured' => $this->remaining_featured,
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'user_id'            => 'required',
            'is_expired'         => 'required',
            'remaining_slots'    => 'required',
            'remaining_repost'   => 'required',
            'remaining_featured' => 'required',
        ];
    }
}
