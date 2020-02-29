<?php

namespace App\Console\Commands;

use App\Services\ListingService;
use Illuminate\Console\Command;

/**
 * Class ListingExpiry
 * @package App\Console\Commands
 */
class ListingExpiry extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'listing:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check expiry for existing listings and archived them.';

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
        $today = now()->format('d-m-Y');
        $listings = (new ListingService())->activeListings();
        foreach ($listings as $key => $listing) {
            print_r("{$listing->created_at->format('d-m-Y')}\n");
        }
    }
}