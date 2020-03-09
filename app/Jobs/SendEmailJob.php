<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class SendEmailJob
 * @package App\Jobs
 */
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array|mixed
     */
    private $data;

    /**
     * @var int
     */
    public $tries = 1;

    /**
     * @var int
     */
    public $timeout = 10;

    /**
     * SendEmailJob constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = is_object($data) ? $data : toObject($data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        switch ($this->data->via) {
            case 'info':
                sendViaInfo($this->data);
                break;
            case 'support':
                sendViaSupport($this->data);
                break;
        }
    }
}
