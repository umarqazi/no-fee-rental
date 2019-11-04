<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class TriggerListingNotification
 * @package App\Events
 */
class TriggerListingNotification implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

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

    /**
     * @return string
     */
    public function broadcastAs() {
        return 'listing';
    }

    /**
     * @return Channel|Channel|Channel[]
     */
    public function broadcastOn() {
        return new Channel('listing-channel.'.$this->data->to);
    }

    /**
     * @return array
     */
    public function broadcastWith() {
        return collect($this->data)->toArray();
    }
}
