<?php

namespace App\Http\Controllers;

use App\Services\CheckAvailabilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckAvailabilityController extends Controller {

    /**
     * @var CheckAvailabilityService
     */
    private $checkAvailabilityService;

    /**
     * CheckAvailabilityController constructor.
     *
     * @param CheckAvailabilityService $checkAvailabilityService
     */
    public function __construct(CheckAvailabilityService $checkAvailabilityService) {
        $this->checkAvailabilityService = $checkAvailabilityService;
    }

    public function index() {

    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function create(Request $request) {
        $response = $this->checkAvailabilityService->create($request);
        return sendResponse($request, $response, 'Check Availability Request has been Sent.', null, 'Request already sent');
    }

    public function edit(Request $request, $id) {

    }

    public function remove(Request $request, $id) {

    }

    public function deny(Request $request, $id) {

    }

    public function accept(Request $request, $id) {

    }

    public function reply(Request $request, $id) {

    }

    public function archive(Request $request, $id) {

    }
}
