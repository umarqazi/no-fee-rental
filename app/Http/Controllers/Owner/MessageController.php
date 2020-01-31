<?php

namespace App\Http\Controllers\Owner;

use App\Services\ListingConversationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ListingConversationController
 * @package App\Http\Controllers\Agent
 */
class MessageController extends Controller {

    /**
     * @var int
     */
    private $paginate = 20;

    /**
     * @var ListingConversationService
     */
    private $conversationService;

    /**
     * MessageController constructor.
     */
    public function __construct() {
        $this->conversationService = new ListingConversationService();
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $conversations = toObject($this->conversationService->fetchConversations($this->paginate));
        return view('owner.conversation', compact('conversations'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function accept(Request $request, $id) {
        $data = null;
        return $this->conversationService->accept($id)
            ? redirect(route('owner.loadConversation', $id)) : false;
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function archive(Request $request, $id) {
        $response = $this->conversationService->archive($id);
        return sendResponse($request, $response, 'Conversation Added to Archive.');
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse|RedirectResponse
     */
    public function unArchive(Request $request, $id) {
        $response = $this->conversationService->unArchive($id);
        return sendResponse($request, $response, 'Conversation Removed from Archive.');
    }

    /**
     * @param $id
     *
     * @return Factory|View
     */
    public function load($id) {
        $collection = $this->conversationService->loadMessages($id);
        return view('owner.inbox', compact('collection'));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function reply(Request $request, $id) {
        $res = $this->conversationService->reply($id, $request);
        return sendResponse($request, $res, null);
    }
}
