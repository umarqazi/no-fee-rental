<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\PaymentForm;
use Cartalyst\Stripe\Stripe;
use App\Repository\ManageCustomerRepo;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService {

    /**
     * @var integer
     */
    private $gateway;

    /**
     * @var object
     */
    private $request;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var object
     */
    private $paymentMethod;

    /**
     * @var ManageCustomerRepo
     */
    protected $customerRepo;

    /**
     * PaymentService constructor.
     *
     * @param $gateway
     */
    public function __construct( $gateway = STRIPE ) {
        $this->gateway = $gateway;
        $this->__setGateway();
        $this->customerRepo   = new ManageCustomerRepo();
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function makePayment( $request ) {
        $this->request = $this->__validateForm( $request );
        if ($customer   = $this->__isNewCustomer()) {
            return $this->__makeTransaction( $customer );
        }

        return $this->__createCard()->__makeTransaction( $this->customer );
    }

    /**
     * @param $customer
     *
     * @return mixed
     */
    private function __makeTransaction( $customer ) {
        $charge = $this->paymentMethod->charges()->create( [
            'currency' => 'usd',
            'customer' => $customer,
            'amount'   => $this->request->amount,
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

        if ($customer) {
            $this->customerRepo->create([
                'email'       => mySelf()->email,
                'customer_id' => $this->customer
            ]);
        }

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
                'name'      => $this->request->card_holder_name,
                'number'    => $this->request->card_number,
                'exp_month' => $this->request->exp_month,
                'cvc'       => $this->request->cvc,
                'exp_year'  => $this->request->exp_year,
            ]
        ] );

        return $token['id'];
    }

    /**
     * @return bool
     */
    private function __setGateway() {
        switch ( $this->gateway ) {
            case STRIPE:
                $this->paymentMethod = new Stripe( config( 'services.stripe.secret' ) );
                break;
            default:
                return false;
        }

        return false;
    }

    /**
     * @return bool|mixed
     */
    private function __isNewCustomer() {
        $customer = $this->customerRepo->find( [ 'email' => mySelf()->email ] )->first();

        return $customer ? $this->__findCustomer( $customer->customer_id ) : false;
    }

    /**
     * @param $customer_id
     *
     * @return bool|mixed
     */
    private function __findCustomer( $customer_id ) {
        $stripeResponse = $this->paymentMethod->customers()->find( $customer_id );

        return $stripeResponse ? $customer_id : false;
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
