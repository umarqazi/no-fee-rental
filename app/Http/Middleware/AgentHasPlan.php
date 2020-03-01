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
     * @var string
     */
    private $headers;

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
        $this->headers = $next($request);

        if(isMRGAgent()) {
            return $this->headers;
        }

        if($this->service->agentHasPlan()) {

            if(mySelf()->created_at->addDays(TRIALDAYS)->format('Y-m-d') >= now()->format('Y-m-d')) {
                return $this->headers;
            }

            if(!$this->service->isExpired() && $this->service->isExpired() !== null) {
                return $this->headers;
            }

            $this->service->listenForExpiry();
            return error('Your plan has been expired');
        }

        return error('You have no subscription plan to post listings');

    }
}
