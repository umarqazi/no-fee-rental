<?php

namespace App\Http\Controllers\Agent;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * @var AgentService
     */
    private $service;

    /**
     * MemberController constructor.
     *
     * @param AgentService $service
     */
    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function get() {
        return dataTable($this->service->getMembers());
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
        if($request->ajax()) {
            $res = ($invite)
                    ? json('Invitation has been sent.', null, true)
                    : json('Something went wrong', null, false, 500);
        } else {
            $res = ($invite)
                    ? success('Invitation has been sent.')
                    : error('Something went wrong');
        }
        return $res;
    }
}

