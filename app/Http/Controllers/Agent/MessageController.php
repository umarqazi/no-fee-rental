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
        $data = null;
        if($this->service->initChat($id))
            $data = $this->service->messages($id)->first();

        return sendResponse($request, $data);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function inbox($id) {
        $collection = $this->service->loadChat($id);
        return view('agent.inbox', compact('collection'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request, $id) {
        if($res = $this->service->send($id, $request)) {
            return sendResponse($request, $res, 'Message has been sent');
        }
    }

    public function delete($id) {

    }
}
