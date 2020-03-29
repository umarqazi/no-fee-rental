<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
    }
}
