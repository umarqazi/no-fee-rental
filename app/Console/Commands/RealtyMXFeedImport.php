<?php

namespace App\Console\Commands;

use App\Http\Controllers\RealtyMXController;
use App\Services\RealtyMXService;
use Illuminate\Console\Command;

class RealtyMXFeedImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:feed {feed-name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing Listings From Realty MX Feed...';

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
    public function handle() {
        printf("%s\n", $this->description);
//        $realtyController = new RealtyMXController(new RealtyMXService);
//        return $realtyController->dispatchJob($this->argument('feed-name'));
    }
}
