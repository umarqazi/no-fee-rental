<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Http\Controllers\Agent;

use App\Services\AppointmentService;
use App\Services\MessageService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class AppointmentController
 * @package App\Http\Controllers\Agent
 */
class AppointmentController extends Controller
{
    /**
     * @var MessageService
     */
    private $appointmentService;

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * AppointmentController constructor.
     *
     * @param AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService) {
        $this->appointmentService = $appointmentService;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $data = toObject($this->appointmentService->fetchAppointments($this->paginate));
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

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function inbox($id) {
        $collection = toObject($this->appointmentService->messages($id));
        return view('agent.inbox', compact('collection'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function reply(Request $request, $id) {
        $res = $this->appointmentService->reply($id, $request);
        return sendResponse($request, $res, null);
    }
}
