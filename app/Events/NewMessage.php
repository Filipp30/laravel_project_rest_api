<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $session;
    public $name;
    public $message;
    public $time;

    public function __construct($session,$username,$message,$time_stamp)
    {
        $this->session = $session;
        $this->message = $message;
        $this->name = $username;
        $this->time = $time_stamp;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('my-channel');
    }
}
