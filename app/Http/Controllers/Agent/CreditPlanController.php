<?php

namespace App\Http\Controllers\Agent;

use App\Services\CreditPlanService;
use App\Services\PaymentService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class StripeController
 * @package App\Http\Controllers\Agent
 */
class CreditPlanController extends Controller {

    /**
     * @var CreditPlanService
     */
    private $creditPlanService;

    /**
     * StripeController constructor.
     */
    public function __construct() {
        $this->creditPlanService = new CreditPlanService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $currentPlan = $this->creditPlanService->currentPlan()->first();
        return view('agent.credit', compact('currentPlan'));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function subscription($id) {
        return view('agent.subscription_plan');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function create(Request $request) {
        $request->card_number = '4242424242424242';
        $request->cvc = '123';
        $request->exp_month = '08';
        $request->exp_year = '2025';
        $request->credit_plan = 'gold';
        $request->amount = '100';
        $request->card_holder_name = 'Yousuf';
        $res = $this->creditPlanService->makePayment($request);
        return sendResponse($request, $res, 'Payment has been sent');
    }
}
