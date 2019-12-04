<?php

namespace App\Http\Controllers\Owner;

use App\Services\MemberService;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class MemberController
 * @package App\Http\Controllers\Owner
 */
class MemberController extends Controller {

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
     * @param MemberService $mService
     * @param UserService $uService
     */
    public function __construct(MemberService $mService, UserService $uService) {
        $this->mService = $mService;
        $this->uService = $uService;
    }

    /**
     * @return Factory|View
     */
    public function index() {
        $team = $this->mService->team();
        return view('owner.members', compact('team'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function get() {
        $data = $this->mService->invites();
        return dataTable(!empty($data) ? $data->invitedOwners : []);
    }

    /**
     *  Send Invitation to agents
     *
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse
     */
    public function invite(Request $request) {
        $invite = $this->uService->sendInvite($request);
        return sendResponse($request, $invite, 'Invitation has been sent.');
    }

    /**
     * @param $token
     *
     * @return RedirectResponse
     */
    public function acceptInvitation($token) {
        $authenticate_token = $this->uService->getAgentToken($token)->first();
       $res  = $this->uService->addMember($authenticate_token);
       if($res){
           return redirect(route('web.index'))
               ->with(['message' => 'You have been added to Team', 'alert_type' => 'success']);
       }

       return redirect()->back();
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function unFriend($id) {
        $this->uService->unFriend($id);

        return redirect(route('agent.team'))
            ->with(['message' => 'Member Removed Successfully', 'alert_type' => 'success']);

    }

}

