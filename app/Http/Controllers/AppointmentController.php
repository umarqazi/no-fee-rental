<?php

namespace App\Http\Controllers;

use App\Services\ListingConversationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller {

    /**
     * @var ListingConversationService
     */
    private $appointmentService;

    /**
     * MakeAppointmentController constructor.
     *
     * @param ListingConversationService $appointmentService
     */
    public function __construct(ListingConversationService $appointmentService) {
        $this->appointmentService = $appointmentService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function create(Request $request) {
        $response = $this->appointmentService->create($request);
        return sendResponse($request, $response, 'Appointment Request has been Sent.', null, 'You Already Send an Appointment Request.');
    }
}
