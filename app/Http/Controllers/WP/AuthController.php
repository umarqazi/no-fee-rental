<?php

namespace App\Http\Controllers\WP;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

/**
 * Class AuthController
 * @package App\Http\Controllers\WP
 */
class AuthController extends Controller {

    /**
     * @var object
     */
    private $data;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request) {
        $this->data = toObject($request->all());
        if($user = $this->__verifyUser()) {

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
                $guard = 'admin';
                break;
            case AGENT:
                $guard = 'agent';
                break;
            case OWNER:
                $guard = 'owner';
                break;
            case RENTER:
                $guard = 'renter';
                break;
        }

        return $guard;
    }
}
