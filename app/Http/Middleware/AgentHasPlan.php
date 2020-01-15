<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\CreditPlanService;

/**
 * Class AgentHasPlan
 * @package App\Http\Middleware
 */
class AgentHasPlan {

    /**
     * @var CreditPlanService
     */
    private $service;

    /**
     * AgentHasPlan constructor.
     */
    public function __construct() {
        $this->service = new CreditPlanService();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if($this->service->agentHasPlan()) {
            if(!$this->service->isExpired() && $this->service->isExpired() !== null) {
                return $next($request);
            }

            $this->service->listenForExpiry();
            return error('Your plan has been expired');
        }

        return error('You have no subscription plan for listings');
    }
}
