<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @var NotificationService
     */
    private $service;

    /**
     * NotificationController constructor.
     *
     * @param NotificationService $service
     */
    public function __construct(NotificationService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function get(Request $request) {
        return sendResponse($request, $this->service->get(), null);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all() {
        $notifications = $this->service->get();
        return view('secured-layouts.notifications', compact('notifications'));
    }
}
