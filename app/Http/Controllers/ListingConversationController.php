<?php

namespace App\Http\Controllers;

use App\Services\ListingConversationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ListingConversationController
 * @package App\Http\Controllers
 */
class ListingConversationController extends Controller {

    /**
     * @var ListingConversationService
     */
    private $conversationService;

    /**
     * ListingConversationController constructor.
     *
     * @param ListingConversationService $service
     */
    public function __construct(ListingConversationService $service) {
        $this->conversationService = $service;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function create(Request $request) {
        $response = $this->conversationService->create($request);
        return sendResponse($request, $response, 'Request has been Sent.', null, 'Request already sent');
    }
}
