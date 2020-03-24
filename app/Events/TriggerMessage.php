<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class TriggerMessage
 * @package App\Events
 */
class TriggerMessage {
    use SerializesModels;

    /**
     * @var array
     */
    private $data;

    /**
     * TriggerMessage constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = (is_object($data)) ? $data : toObject($data);
    }
}
