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
        if(isMRGAgent() || mySelf()->created_at->addDays(TRIALDAYS)->format('Y-m-d') >= now()->format('Y-m-d')) {
            return $this->headers;
        }

        if($this->service->agentHasPlan()) {
            if(!$this->service->isExpired() && $this->service->isExpired() !== null) {
                return $this->__performAction($request);
            }

            $this->service->listenForExpiry();
            return error('Your plan has been expired');
        }

        return error('You have no subscription plan for listings');
    }

    /**
     * @param $request
     * @return bool
     */
    private function __performAction($request) {
        switch ($request->route()->getName()) {
            case 'agent.addListing':
            case 'agent.createListingImages':
            case 'agent.copyListing':
                return $this->__slotsAction();
                break;
            case 'agent.repostListing':
                return $this->__repostAction();
                break;
            case 'agent.archive':
                return $this->__archiving();
                break;
            case 'agent.unArchive':
                return $this->__unArchiving();
                break;
            default:
                return true;
                break;
        }
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function __slotsAction() {
        if($this->service->isSlotsExist()) {
            return $this->headers;
        }

        return $this->service->_FILO() ? $this->headers : error('Something Went Wrong');
    }

    /**
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function __repostAction() {
        return $this->service->isRepostsExist()
            ? $this->headers
            : $this->service->_FILO();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|string
     */
    private function __archiving() {
        return $this->service->archive() ? $this->headers : error('Something Went Wrong.');
    }

    /**
     * @return bool|string
     */
    private function __unArchiving() {
        return $this->service->unArchive() ? $this->headers : error('Something Went Wrong.');
    }
}
