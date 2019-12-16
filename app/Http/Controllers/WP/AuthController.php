<?php

namespace App\Http\Controllers\WP;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

/**
 * Class AuthController
 * @package App\Http\Controllers\WP
 */
class AuthController extends Controller {

    use AuthenticatesUsers;

    /**
     * @var object
     */
    private $data;

    /**
     * @var string
     */
    private $guard;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request) {
        $this->data = toObject($request->all());
        $user = $this->__verifyUser();
        if($user && $this->attemptLogin($request)) {
            return response()->json([
                'status' => true,
                'guard' => $this->__guardAssign($user),
                'msg' => 'Authentication successful',
                'api_token' => $user->api_token
            ], 200);
        }

        return response()->json([
            'status' => false,
            'msg' => 'Wrong email or password',
        ], 401);
    }

    /**
     * @return mixed
     */
    private function __verifyUser() {
        $auth = null;
        $user = \App\User::where('email', $this->data->email)->first();
        if(!empty($user)) {
            $auth = Hash::check($this->data->password, $user->password);
        }

        return ($user && $auth) ? $user : false;
    }

    /**
     * @param $user
     * @return string|null
     */
    private function __guardAssign($user) {
        $guard = null;
        switch($user->user_type) {
            case ADMIN:
                $this->guard = 'admin';
                break;
            case AGENT:
                $this->guard = 'agent';
                break;
            case OWNER:
                $this->guard = 'owner';
                break;
            case RENTER:
                $this->guard = 'renter';
                break;
        }

        return $this->guard;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard(){
        return Auth::guard($this->guard);
    }
}
