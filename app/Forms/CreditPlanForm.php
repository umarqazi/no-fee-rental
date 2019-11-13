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
    public $plan;

    /**
     * @var int
     */
    public $remaining_repost;

    /**
     * @var int
     */
    public $remaining_featured;

    /**
     * @var string
     */
    public $txn_id;

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
            'plan'               => $this->plan,
            'is_expired'         => $this->is_expired,
            'remaining_repost'   => $this->remaining_repost,
            'remaining_featured' => $this->remaining_featured,
            'txn_id'             => $this->txn_id,
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'user_id'            => 'required',
            'plan'               => 'required',
            'is_expired'         => 'required',
            'remaining_repost'   => 'required',
            'remaining_featured' => 'required',
            'txn_id'             => 'required',
        ];
    }
}
