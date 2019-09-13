<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TriggerMessage implements ShouldBroadcast {
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
        (is_object($data)) ?: $data = toObject($data);
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function broadcastAs() {
        return 'message';
    }

    /**
     * @return Channel|\Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn() {
        return new Channel('messaging-channel.'.$this->data->to);
    }

    /**
     * @return array
     */
    public function broadcastWith() {
        return collect($this->data)->toArray();
    }
}
