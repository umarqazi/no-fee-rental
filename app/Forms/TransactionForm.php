<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/14/20
 * Time: 2:20 PM
 */

namespace App\Forms;

/**
 * Class TransactionForm
 * @package App\Forms
 */
class TransactionForm extends BaseForm {

    /**
     * @var string
     */
    public $txn_id;

    /**
     * @var string
     */
    public $txn_status;

    /**
     * @var string
     */
    public $receipt_url;

    /**
     * @var string
     */
    public $plan;

    /**
     * @var integer
     */
    public $amt_paid;

    /**
     * @var integer
     */
    public $user_id;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'plan'        => $this->plan,
            'txn_id'      => $this->txn_id,
            'user_id'     => $this->user_id,
            'amt_paid'    => $this->amt_paid,
            'receipt_url' => $this->receipt_url,
            'txn_status'  => $this->txn_status
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'plan'        => 'required',
            'txn_id'      => 'required',
            'user_id'     => 'required',
            'amt_paid'    => 'required',
            'receipt_url' => 'required',
            'txn_status'  => 'required'
        ];
    }
}