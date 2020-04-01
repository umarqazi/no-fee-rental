<?php

namespace App\Http\Middleware;

use App\Services\AuthService;
use App\Traits\UserSoftDelete;
use Closure;

/**
 * Class IsAccountActive
 * @package App\Http\Middleware
 */
class IsAccountActive
{

    use UserSoftDelete;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->_isActive()) {
            $this->triggerEvents(mySelf());
            return (new AuthService(whoAmI()))->logout($request);
        }

        return $next($request);
    }

    /**
     * @return bool
     */
    private function _isActive()
    {
        $user = \App\User::where('id', myId())->select('status')->first();
        return $user->status === ACTIVE;
    }
}
