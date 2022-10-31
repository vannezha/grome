<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SetEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public Array $message;
    public String $username;
    public String $guid;
    public function __construct(Array $message, String $username, String $guid)
    {
        $this->message = $message;
        $this->username = $username;
        $this->guid = $guid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("set"."_".$this->username."_".$this->guid);
    }

    public function broadcastWith(){
        return $this->message;
        // return [
        //     'message' => $this->message,
        // ];
    }
}
