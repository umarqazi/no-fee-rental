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
        $currentPlan = $this->creditPlanService->myPlan();
        return view('agent.credit', compact('currentPlan'));
    }

    /**
     * @return Factory|View
     */
    public function subscription() {
        $currentPlan = $this->creditPlanService->myPlan();
        $transactions = $this->creditPlanService->myTransactions();
        return view('agent.subscription_plan', compact('transactions', 'currentPlan'));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function create(Request $request) {
        $res = $this->creditPlanService->purchasePlan($request);
        return sendResponse($request, $res, 'Payment has been sent');
    }
}
