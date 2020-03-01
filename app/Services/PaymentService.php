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
     * @var string
     */
    private $card;

    /**
     * @var string
     */
    private $plan;

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
     * @var string
     */
    private $subscription;

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
    protected function __construct( $gateway = STRIPE ) {
        $this->gateway = $gateway; $this->__setGateway();
        $this->customerRepo   = new ManageCustomerRepo();
    }

    /**
     * @param $request
     * @return PaymentService|mixed
     */
    protected function __makePayment( $request ) {

        $this->request = $this->__validateForm( $request );

        if ($this->customer = $this->__isNewCustomer()) {
            return $this->__makeTransaction( $request );
        }

        $this->__createCard()->__makeTransaction( $request );
        return $this->__saveDetails();
    }

    /**
     * @return mixed
     */
    protected function __cancelSubscription() {
        $data = $this->customerRepo->find(['user_id' => myId()])->first();
        $this->customer = $data->customer_id;
        $this->subscription = $data->subscription_id;
        return $this->__cancelPlan();
    }

    /**
     * @return mixed
     */
    protected function __getProducts() {
        return  $this->paymentMethod->plans()->all();
    }

    /**
     * @return string
     */
    private function __createSubscription() {
        $subscription = $this->paymentMethod->subscriptions()->create($this->customer, [
            'plan' => $this->plan,
            'trial_end' => strtotime(now()->addDays(TRIALDAYS))
        ]);

        $this->subscription = $subscription['id'];
        return $subscription;
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function __upgradePlan($request) {
        $this->plan = $this->__selectedPlan($request->credit_plan);
        $customer = $this->customerRepo->find(['user_id' => myId()])->first();
        $subscription = $this->paymentMethod->subscriptions()
            ->update($customer->customer_id, $customer->subscription_id, [
                'plan' => $this->plan
            ]);

        return $subscription;
    }

    /**
     * @return mixed
     */
    private function __cancelPlan() {
        return $this->paymentMethod->subscriptions()->cancel($this->customer, $this->subscription, true);
    }

    /**
     * @param $request
     * @return string
     */
    private function __makeTransaction( $request ) {
        $this->plan = $this->__selectedPlan($request->credit_plan);
        return $this->__createSubscription();
    }

    /**
     * @param $plan
     * @return bool|object
     */
    private function __selectedPlan($plan) {
        switch ($plan) {
            case BASICPLAN:
                return BASICPLANID;
                break;
            case GOLDPLAN:
                return GOLDPLANID;
                break;
            case PLATINUMPLAN:
                return PLATINUMPLANID;
                break;
        }

        return false;
    }

    /**
     * @return mixed
     */
    private function __createCustomer() {
        $customer = $this->paymentMethod->customers()->create( [
            'email' => mySelf()->email
        ] );

        return $this->customer = $customer['id'];
    }

    /**
     * @return mixed
     */
    private function __createCard() {
        $card = $this->paymentMethod
                     ->cards()
                     ->create( $this->__createCustomer(), $this->__createToken() );

        $this->card = $card['id'];
        return $this;
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function __changeCard($request) {
        $this->request = $this->__validateForm($request);
        $credentials = $this->customerRepo->find(['user_id' => myId()])->first();
        $this->paymentMethod->cards()->delete($credentials->customer_id, $credentials->card_id);
        return $this->__createCard()->__updateCardDetails();
    }

    /**
     * @return mixed
     */
    private function __updateCardDetails() {
        return $this->customerRepo->updateByClause(['user_id' => myId()], [
            'user_id'         => myId(),
            'card_id'         => $this->card,
            'customer_id'     => $this->customer
        ]);
    }

    /**
     * @return $this
     */
    private function __saveDetails() {
        return $this->customerRepo->create([
            'user_id'         => myId(),
            'card_id'         => $this->card,
            'customer_id'     => $this->customer,
            'subscription_id' => $this->subscription
        ]);
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
        $customer = $this->customerRepo->find( [ 'user_id' => myId() ] )->first();

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
        $form->plan             = $this->__selectedPlan($request->credit_plan);
        $form->validate();

        return $form;
    }
}
