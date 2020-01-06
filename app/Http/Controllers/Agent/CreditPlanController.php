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
     * @var PaymentService
     */
    private $paymentService;

    private $creditPlanService;

    /**
     * StripeController constructor.
     */
    public function __construct() {
        $this->paymentService = new PaymentService();
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
        $res = $this->paymentService->makePayment($request);
        return sendResponse($request, $res, 'Payment has been sent');
    }
}
