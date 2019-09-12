<?php

namespace App\Http\Controllers\Agent;

use App\Services\MemberService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * @var MemberService
     */
    private $service;

    /**
     * MemberController constructor.
     *
     * @param MemberService $service
     */
    public function __construct(MemberService $service) {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $team = $this->service->team();
        return view('agent.members', compact('team'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get() {
        return dataTable($this->service->invites()->invitedAgents);
    }

    /**
     *  Send Invitation to agents
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function invite(Request $request) {
        $invite = $this->service->sendInvite($request);
        return sendResponse($request, $invite, 'Invitation has been sent.');
    }
}

