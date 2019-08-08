<?php

namespace App\Http\Controllers;

use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private $service;

    /**
     * MessageController constructor.
     *
     * @param MessageService $service
     */
    public function __construct(MessageService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request) {
        return ($this->service->sendRequest($request))
            ? success('Request has been sent successfully')
            : error('Something went wrong');
    }
}
