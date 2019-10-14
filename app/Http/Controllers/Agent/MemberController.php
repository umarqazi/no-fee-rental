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
    private $uService;

    /**
     * @var MemberService
     */
    private $mService;

    /**
     * MemberController constructor.
     *
     * @param MemberService $service
     */
    public function __construct(MemberService $mService, UserService $uService) {
        $this->mService = $mService;
        $this->uService = $uService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $team = $this->mService->team();
        return view('agent.members', compact('team'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get() {
        $data = $this->mService->invites();
        return dataTable(!empty($data) ? $data->invitedAgents : []);
    }

    /**
     *  Send Invitation to agents
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function invite(Request $request) {
        $invite = $this->uService->sendInvite($request);
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
        $authenticate_token = $this->uService->getAgentToken($token)->first();
       $res  = $this->uService->addMember($authenticate_token);
       if($res){
           return redirect(route('web.index'))
               ->with(['message' => 'You have been added to Team', 'alert_type' => 'success']);
       }
    }

    /**
     * un friend Agent
     */
    public function unFriend($id) {
        $this->uService->unFriend($id);

        return redirect(route('agent.team'))
            ->with(['message' => 'Member Removed Successfully', 'alert_type' => 'success']);

    }

}

