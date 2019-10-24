<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TriggerNotification implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    private $data;

    /**
     * TriggerNotification constructor.
     *
     * @param $data
     */
    public function __construct($data) {
        $this->data = (is_object($data)) ? $data : toObject($data);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn() {
        return new Channel('notification-channel.'. $this->data->to);
    }

    /**
     * @return string
     */
    public function broadcastAs() {
        return 'notification';
    }

    /**
     * @return array
     */
    public function broadcastWith() {
        return collect($this->data)->toArray();
    }
}
