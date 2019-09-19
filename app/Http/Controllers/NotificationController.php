<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function markAsRead(Request $request) {
        return $this->service->markAsRead($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function push(Request $request) {
        $notification = [
            'from'         => $request->sender['id'],
            'to'           => myId(),
            'sender'       => $request->sender,
            'subject'      => 'New Message Arrive',
            'view'         => 'message-receive',
            'path'         => route('agent.messageIndex'),
            'body'         => $request->message,
            'notification' => "New message received from {$request->sender['first_name']} {$request->sender['last_name']}",
            'toName'       => mySelf()->first_name,
            'toEmail'      => mySelf()->email
        ];
        $this->service->setter($notification)->send();
        return sendResponse($request, true, 'New message receive from '.$request->sender['first_name']. ' ' .$request->sender['last_name']);
    }

    /**
     * @param $id
     *
     * @return bool|mixed
     */
    public function delete($id) {
        return $this->service->delete($id);
    }
}
