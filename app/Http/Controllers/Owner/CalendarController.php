<?php

namespace App\Http\Controllers\Owner;

use App\CalendarEvent;
use App\Services\CalendarService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class CalendarController
 * @package App\Http\Controllers\Owner
 */
class CalendarController extends Controller {

    /**
     * @var CalendarService
     */
    private $calendarService;

    /**
     * CalendarController constructor.
     */
    public function __construct() {
        $this->calendarService = new CalendarService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $calendar = $this->calendarService->index();
        return view('owner.calendar', compact('calendar'));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function create(Request $request) {
        $request->model = CalendarEvent::class;
        $res = $this->calendarService->addEvent($request);
        return sendResponse($request, $res, 'Event has been added.');
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function edit($id, Request $request) {
        $data = $this->calendarService->editEvent($id);
        return sendResponse($request, $data, null);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function update($id, Request $request) {
        $res = $this->calendarService->updateEvent($id, $request);
        return sendResponse($request, $res, 'Event has been Updated.');
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function delete($id, Request $request) {
        $res = $this->calendarService->removeEvent($id);
        return sendResponse($request, $res, 'Event has been Deleted.');
    }
}
