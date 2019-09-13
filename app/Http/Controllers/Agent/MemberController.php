<?php

namespace App\Http\Controllers\Agent;

use App\Services\MemberService;
use App\Services\UserService;
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
    public function __construct(MemberService $service, UserService $service1) {
        $this->service = $service;
        $this->service1 = $service1;
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
        $data = $this->service->invites();
        return dataTable(!empty($data) ? $data->invitedAgent : []);
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
    /**
     *  Accept Invitation
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function acceptInvitation($token) {
        $authenticate_token = $this->service->getAgentToken($token)->first();
       $res  = $this->service1->addMember($authenticate_token);
       if($res){
           return redirect(route('web.index'))
               ->with(['message' => 'You have been added to Team', 'alert_type' => 'success']);
       }
    }
}

