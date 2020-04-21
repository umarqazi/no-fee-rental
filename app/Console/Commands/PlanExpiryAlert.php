<?php

namespace App\Console\Commands;

use App\CreditPlan;
use App\Services\CreditPlanService;
use Illuminate\Console\Command;

/**
 * Class PlanExpiryAlert
 * @package App\Console\Commands
 */
class PlanExpiryAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plan:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for Users Who\'s plans about to expire.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $plans = (new CreditPlanService());
        foreach($plans->allActivePlans()->get() as $plan) {
            if($plan->created_at->addDays(30)->format('d-m-Y') <= now()->format('d-m-Y')) {
                $plans->listenForExpiry($plan->id);
            }
        }
    }
}
