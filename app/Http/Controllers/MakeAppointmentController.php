<?php

namespace App\Http\Controllers;

use App\Services\AppointmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MakeAppointmentController extends Controller {

    /**
     * @var AppointmentService
     */
    private $appointmentService;

    /**
     * MakeAppointmentController constructor.
     *
     * @param AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService) {
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
