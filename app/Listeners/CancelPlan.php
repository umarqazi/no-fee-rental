<?php

namespace App\Listeners;

use App\Repository\CreditPlanRepo;
use App\Services\CreditPlanService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class CancelPlan
 * @package App\Listeners
 */
class CancelPlan
{

    /**
     * @var CreditPlanService
     */
    private $creditPlanRepo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->creditPlanRepo = new CreditPlanRepo();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
//        $this->creditPlanRepo->;
    }
}
