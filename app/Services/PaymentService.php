<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\PaymentForm;
use App\Repository\PaymentRepo;
use Cartalyst\Stripe\Stripe;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService {

    /**
     * @var
     */
    protected $paymentRepo;

    /**
     * @var object
     */
    private $paymentMethod;

    /**
     * @var integer
     */
    private $gateway;

    /**
     * @var object
     */
    private $data;

    /**
     * @var string
     */
    private $customer;

    /**
     * PaymentService constructor.
     *
     * @param $gateway
     */
    public function __construct( $gateway = STRIPE ) {
        $this->gateway = $gateway;
        $this->__setGateway();
        $this->paymentRepo = new PaymentRepo();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function makePayment( $data ) {
        $this->data = toObject( $this->__validateForm( $data ) );
        $customer   = $this->__isNewCustomer();
        if ( $customer ) {
            return $this->__createTransaction( $customer );
        }

        return $this->__createCard()->__createTransaction( $this->customer );
    }

    /**
     * @param $customer
     *
     * @return mixed
     */
    private function __createTransaction( $customer ) {
        $charge = $this->paymentMethod->charges()->create( [
            'currency' => 'usd',
            'customer' => $customer,
            'amount'   => $this->data->amount,
        ] );

        return $charge;
    }

    /**
     * @return string
     */
    private function __createCustomer() {
        $customer = $this->paymentMethod->customers()->create( [
            'email' => mySelf()->email
        ] );

        $this->customer = $customer['id'];

        return $this->customer;
    }

    /**
     * @return mixed
     */
    private function __createCard() {
        $this->paymentMethod
            ->cards()
            ->create( $this->__createCustomer(), $this->__createToken() );

        return $this;
    }

    /**
     * @return mixed
     */
    private function __createToken() {
        $token = $this->paymentMethod->tokens()->create( [
            'card' => [
                'name'      => $this->data->card_holder_name,
                'number'    => $this->data->card_number,
                'exp_month' => $this->data->exp_month,
                'cvc'       => $this->data->cvc,
                'exp_year'  => $this->data->exp_year,
            ]
        ] );

        return $token['id'];
    }

    /**
     * Set Gateway for payment
     */
    private function __setGateway() {
        switch ( $this->gateway ) {
            case STRIPE:
                $this->paymentMethod = new Stripe( config( 'services.stripe.secret' ) );
                break;
        }
    }

    /**
     * @return bool|mixed
     */
    private function __isNewCustomer() {
        $customer = $this->paymentRepo->find( [ 'user_id' => myId() ] )->first();

        return $customer ? $this->__findCustomer( $customer->customer_id ) : false;
    }

    /**
     * @param $customer_id
     *
     * @return bool|mixed
     */
    private function __findCustomer( $customer_id ) {
        $stripeResponse = $this->paymentMethod->customers()->find( $customer_id );

        return $stripeResponse['deleted'] !== true ? $customer_id : false;
    }

    /**
     * @param $request
     *
     * @return PaymentForm
     */
    private function __validateForm( $request ) {
        $form                   = new PaymentForm();
        $form->card_number      = $request->card_number;
        $form->amount           = $request->amount;
        $form->card_holder_name = $request->card_holder_name;
        $form->cvc              = $request->cvc;
        $form->exp_month        = $request->exp_month;
        $form->exp_year         = $request->exp_year;
        $form->validate();

        return $form;
    }
}
