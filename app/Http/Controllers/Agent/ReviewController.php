<?php

namespace App\Http\Controllers\Agent;

use App\Services\ReviewService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ReviewController
 * @package App\Http\Controllers\Agent
 */
class ReviewController extends Controller {

    /**
     * @var ReviewService
     */
    private $reviewService;

    /**
     * ReviewController constructor.
     */
    public function __construct() {
        $this->reviewService = new ReviewService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $reviews = $this->reviewService->get();
        return view('agent.reviews', compact('reviews'));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function request(Request $request) {
        $res = $this->reviewService->sendRequest($request);
        return sendResponse($request, $res, 'Request has been sent.');
    }

    public function show() {

    }

    public function hide() {

    }
}