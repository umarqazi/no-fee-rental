<?php

namespace App\Http\Controllers\Agent;

use App\Services\ListingConversationService;
use App\Services\CheckAvailabilityService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MessageController extends Controller {

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * @var ListingConversationService
     */
    private $appointmentService;

    /**
     * @var CheckAvailabilityService
     */
    private $checkAvailabilityService;

    /**
     * MessageController constructor.
     */
    public function __construct() {
        $this->appointmentService = new ListingConversationService();
        $this->checkAvailabilityService = new CheckAvailabilityService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $data = toObject([
            'appointments'   => $this->appointmentService->fetchAppointments($this->paginate),
            'availabilities' => $this->checkAvailabilityService->fetchAvailabilities($this->paginate)
        ]);
        return view('agent.message', compact('data'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function accept(Request $request, $id) {
        $data = null;
        if($this->appointmentService->accept($id))
            $data = $this->appointmentService->messages($id);
        return sendResponse($request, $data);
    }

    public function deny() {

    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function archiveInbox(Request $request, $id) {
        $response = $this->appointmentService->archive($id);
        return sendResponse($request, $response, 'Chat added to Archive.');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function archiveAvailability(Request $request, $id) {
        $response = $this->checkAvailabilityService->archive($id);
        return sendResponse($request, $response, 'Chat added to Archive.');
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function loadInbox($id) {
        $collection = toObject($this->appointmentService->messages($id));
        return view('agent.inbox', compact('collection'))->with('route', 'agent.sendInboxMessage');
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function loadAvailability($id) {
        $collection = toObject($this->checkAvailabilityService->messages($id));
        return view('agent.inbox', compact('collection'))->with('route', 'agent.sendAvailabilityMessage');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function replyInbox(Request $request, $id) {
        $res = $this->appointmentService->reply($id, $request);
        return sendResponse($request, $res, null);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function replyAvailability(Request $request, $id) {
        $res = $this->checkAvailabilityService->reply($id, $request);
        return sendResponse($request, $res, null);
    }
}
