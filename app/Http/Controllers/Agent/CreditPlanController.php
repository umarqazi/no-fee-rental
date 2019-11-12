<?php

namespace App\Http\Controllers\Agent;

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

    /**
     * StripeController constructor.
     */
    public function __construct() {
        $this->paymentService = new PaymentService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        return view('agent.credit_plan');
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
