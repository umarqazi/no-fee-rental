<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */
namespace App\Http\Controllers\Agent;

use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private $service;

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * MessageController constructor.
     *
     * @param MessageService $service
     */
    public function __construct(MessageService $service) {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $data = $this->service->get($this->paginate);
        return view('agent.message', compact('data'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function confirmMeeting(Request $request, $id) {
        $status = $this->service->initChat($id);
        if($request->ajax()) {
            $res = ($status) ?: json('Something went wrong', null, false);
        } else {
            $res = ($status) ?: error('Something went wrong');
        }

        return $res;
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadChat(Request $request, $id) {
        $chat = $this->service->loadChat($id, $this->paginate);
        return view('agent.chat_inbox', compact('chat'));
//        if($request->ajax()) {
//            $res = ($chat) ? json(null, $chat) : json('Something went wrong');
//        } else {
//            $res = null;
//        }
//        return $res;
    }

    public function send(Request $request) {

    }

    public function delete($id) {

    }
}
