<?php

namespace App\Http\Controllers\Agent;

use App\Services\InvitationService;
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
    private $memberService;

    /**
     * @var MemberService
     */
    private $invitationService;

    /**
     * MemberController constructor.
     */
    public function __construct() {
        $this->memberService = new MemberService();
        $this->invitationService = new InvitationService();
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function invite(Request $request) {
        $invite = $this->invitationService->invite($request);
        return sendResponse($request, $invite, 'Invitation has been sent.', null, 'Email already exists with some other user type.');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function validateEmail(Request $request) {
        return $this->invitationService->validateEmail($request);
    }

    public function notAmI(Request $request) {

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

