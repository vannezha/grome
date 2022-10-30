<?php

// namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArduinoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    protected String $message;
    public String $username;
    public String $guid;
    public function __construct(String $message, String $username, String $guid)
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
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }

    public function broadcastOn()
    {
        return new Channel($this->username."_".$this->guid);
    }

    // ini nambahin 2 fungsi buat custome event dan data
    // public function broadcastAs(){
    //     // return $this->guid;
    //     return "App\Events\ArduinoEvent";
    // }

    public function broadcastWith(){
        return [
            'message' => $this->message,
        ];
    }
}
