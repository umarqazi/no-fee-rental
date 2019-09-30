<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array|mixed
     */
    private $data;

    /**
     * SendEmailJob constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = (object) $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        mail($this->data->to, $this->data);
    }
}
