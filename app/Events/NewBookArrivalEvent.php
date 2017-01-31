<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewBookArrivalEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $message;
    public function __construct($msg)
    {
        $this->message = $msg;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['DL_Laravel'];
    }
}
