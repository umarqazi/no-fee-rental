<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;

class FakerFill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:fill {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use to Seed all tables';

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
        printf("Seeding Listing\n");
        $amount = $this->argument('amount');
        factory(\App\Listing::class, (int) $amount)->create();
        printf("Seeding Listing Types\n");
        factory(\App\ListingTypes::class, (int) $amount)->create();
    }
}
