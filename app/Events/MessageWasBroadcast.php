<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageWasBroadcast extends Event implements ShouldBroadcast
{
    use SerializesModels;
    
    /**
     * @var
     */
    public $message;

    /**
     * @var
     */
    public $channel;

    /**
     * @var
     */
    public $alert;

    /**
     * Create a new event instance.
     *
     * @param $message
     * @param $channel
     * @param $alert
     */
    public function __construct($message, $channel, $alert)
    {
        $this->alert = $alert;
        $this->channel = $channel;
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->channel];
    }
}
