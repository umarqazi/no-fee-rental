<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\CreditPlanForm;
use App\Forms\PaymentForm;
use App\Repository\CreditPlanRepo;
use App\Repository\ManageCustomerRepo;
use App\Traits\DispatchNotificationService;
use Cartalyst\Stripe\Stripe;

/**
 * Class PaymentService
 * @package App\Services
 */
class PaymentService {

    use DispatchNotificationService;

    /**
     * @var integer
     */
    private $gateway;

    /**
     * @var object
     */
    private $stripe;

    /**
     * @var object
     */
    private $request;

    /**
     * @var string
     */
    private $customer;

    /**
     * @var ManageCustomerRepo
     */
    protected $customerRepo;

    /**
     * @var CreditPlanRepo
     */
    protected $creditPlanRepo;

    /**
     * @var object
     */
    private $paymentMethod;

    /**
     * PaymentService constructor.
     *
     * @param $gateway
     */
    public function __construct( $gateway = STRIPE ) {
        $this->gateway = $gateway;
        $this->__setGateway();
        $this->creditPlanRepo = new CreditPlanRepo();
        $this->customerRepo   = new ManageCustomerRepo();
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function makePayment( $data ) {
        $this->request = toObject($data);
        $this->stripe = toObject( $this->__validateForm( $this->request ) );
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
            'amount'   => $this->stripe->amount,
        ] );

        $this->__createPlan(toObject($charge));
        return $charge;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    private function __createPlan($data) {
        $data = [
            'plan'               => $this->request->credit_plan,
            'remaining_repost'   => $this->request->remaining_repost ?? 60,
            'txn_id'             => $data->balance_transaction ?? null,
            'remaining_featured' => $this->request->remaining_featured ?? 60,
        ];

        $credit = $this->__validateCreditPlanForm(toObject($data));
        $plan = $this->creditPlanRepo->create($credit->toArray());
        DispatchNotificationService::PLANPURCHASED(toObject([
            'to' => myId(),
            'from' => mailToAdmin(),
            'data' => $plan
        ]));

        return $plan;
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
                'name'      => $this->stripe->card_holder_name,
                'number'    => $this->stripe->card_number,
                'exp_month' => $this->stripe->exp_month,
                'cvc'       => $this->stripe->cvc,
                'exp_year'  => $this->stripe->exp_year,
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

    /**
     * @param $request
     *
     * @return CreditPlanForm
     */
    private function __validateCreditPlanForm($request) {
        $form                     = new CreditPlanForm();
        $form->user_id            = myId();
        $form->txn_id             = $request->txn_id;
        $form->plan               = $request->plan;
        $form->is_expired         = NOTEXPIRED;
        $form->remaining_repost   = $request->remaining_repost;
        $form->remaining_featured = $request->remaining_featured;
        $form->validate();
        return $form;
    }
}
