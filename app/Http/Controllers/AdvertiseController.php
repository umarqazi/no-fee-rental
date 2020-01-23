<?php

namespace App\Http\Controllers;

use App\Services\CreditPlanService;
use Illuminate\Http\Request;

class AdvertiseController extends Controller {

    /**
     * @var CreditPlanService
     */
    private $creditPlanService;

    /**
     * AdvertiseController constructor.
     */
    public function __construct() {
        $this->creditPlanService = new CreditPlanService();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $currentPlan = authenticated() ? $this->creditPlanService->myPlan() : null;
        return view('advertise_with_us', compact('currentPlan'));
    }
}
