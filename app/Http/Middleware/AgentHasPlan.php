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

        if(isMRGAgent()) {
            return $next($request);
        }

        if($this->service->agentHasPlan()) {
            if(!$this->service->isExpired() && $this->service->isExpired() !== null) {
                $this->__performAction($request);
                return $next($request);
            }

            $this->service->listenForExpiry();
            return error('Your plan has been expired');
        }

        return error('You have no subscription plan for listings');
    }

    private function __performAction($request) {
        switch ($request->route()->getName()) {
            case 'agent.addListing':
            case 'agent.createListingImages':
            case 'agent.copyListing':

                break;
            case 'agent.repostListing':

                break;
            case 'agent.unArchive':

                break;
            default:
                return true;
                break;
        }
    }
}
