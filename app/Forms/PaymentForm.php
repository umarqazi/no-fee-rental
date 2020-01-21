<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */


namespace App\Forms;

/**
 * Class PaymentForm
 * @package App\Forms
 */
class PaymentForm extends BaseForm {

    /**
     * @var integer
     */
    public $cvc;

    /**
     * @var integer
     */
    public $amount;

    /**
     * @var string
     */
    public $exp_month;

    /**
     * @var string
     */
    public $exp_year;

    /**
     * @var string
     */
    public $plan;

    /**
     * @var string
     */
    public $card_holder_name;

    /**
     * @var string
     */
    public $card_number;

    /**
     * @return array
     */
    public function toArray() {
        return [
            'card'      => $this->card_number,
            'name'      => $this->card_holder_name,
            'cvc'       => $this->cvc,
            'amount'    => $this->amount,
            'plan'      => $this->plan,
            'exp_month' => $this->exp_month,
            'exp_year'  => $this->exp_year
        ];
    }

    /**
     * @return array|mixed
     */
    public function rules() {
        return [
            'card'      => 'required|max:16',
            'cvc'       => 'required|max:3',
            'name'      => 'required',
            'exp_month' => 'required|max:2',
            'exp_year'  => 'required|max:4'
        ];
    }
}
