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
    public $user;
    public $message;
    public $created_at;

    public function __construct($session,$user,$message,$time_stamp)
    {
        $this->session = $session;
        $this->message = $message;
        $this->user = $user;
        $this->created_at = $time_stamp;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('my-channel');
    }
}
