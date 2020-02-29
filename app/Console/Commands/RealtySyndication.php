<?php

namespace App\Console\Commands;

use App\Http\Controllers\RealtyMXController;
use App\Services\RealtyMXService;
use Illuminate\Console\Command;

/**
 * Class RealtySyndication
 * @package App\Console\Commands
 */
class RealtySyndication extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'realty:syndication';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realty MX Feed Syndication.';

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
     * @return bool
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        printf("%s\n", $this->description);
        $realtyController = new RealtyMXController(new RealtyMXService());
        return $realtyController->dispatchJob();
    }
}
