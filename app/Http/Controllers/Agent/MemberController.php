<?php

namespace App\Http\Controllers\Agent;

use App\Services\MemberService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class MemberController
 * @package App\Http\Controllers\Agent
 */
class MemberController extends Controller {

    /**
     * @var MemberService
     */
    private $userService;

    /**
     * @var MemberService
     */
    private $memberService;

    /**
     * MemberController constructor.
     */
    public function __construct() {
        $this->memberService = new MemberService();
        $this->userService = new UserService();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $team = $this->memberService->members();
        return view('agent.members', compact('team'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get() {
        $data = $this->memberService->invites();
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
        if($request->email == mySelf()->email){
            $invite = 'false' ;
            return sendResponse($request, $invite, 'Invitation cannot be sent to yourself.');
        }
        else {
            $invite = $this->userService->sendInvite($request);
            return sendResponse($request, $invite, 'Invitation has been sent.');
        }
    }
    /**
     *  Accept Invitation
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function acceptInvitation($token) {
        $authenticate_token = $this->userService->getAgentToken($token)->first();
       $res  = $this->userService->addMember($authenticate_token);
       if($res){
           return redirect(route('web.index'))
               ->with(['message' => 'You have been added to Team', 'alert_type' => 'success']);
       }
    }

    /**
     * un friend Agent
     */
    public function unFriend($id) {
        $this->memberService->unFriend($id);

        return redirect(route('agent.team'))
            ->with(['message' => 'Member Removed Successfully', 'alert_type' => 'success']);

    }

}

