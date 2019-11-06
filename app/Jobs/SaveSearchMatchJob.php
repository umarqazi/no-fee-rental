<?php

namespace App\Jobs;

use App\Services\SaveSearchService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class SaveSearchMatchJob
 * @package App\Jobs
 */
class SaveSearchMatchJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var object
     */
    private $data;

    /**
     * @var object
     */
    private $saveSearchService;

    /**
     * @var object
     */
    private $userService;

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
    public function __construct( $data ) {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $this->saveSearchService = new SaveSearchService();
        $matchFounds             = $this->saveSearchService->match( $this->data );
        if ( ! empty( $matchFounds ) ) {
            foreach ( $matchFounds as $results ) {
                $data = [
                    'from'         => $this->data['sender']->id,
                    'sender'       => $this->data['sender'],
                    'to'           => $results['user_id'],
                    'message'      => 'Listing Found',
                    'url'          => route('listing.detail', $this->data['list_id'])
                ];
                dispatchNotification($data);
            }
        } else {
            printf("[%s] No Save Keywords Match Found For Current Listing..\n", now()->format('Y-m-d'));
        }
    }
}
