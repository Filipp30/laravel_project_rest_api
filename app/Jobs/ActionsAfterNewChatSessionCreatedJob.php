<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ActionsAfterNewChatSessionCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $session;


    public function __construct($user,$session){
        $this->user = $user;
        $this->session = $session;
    }


    public function handle(){
        logs()->info('send notification (sms and/or email) to admin when new chat-session was created
        and call pusher-event:New message  with Welcome message to user');
    }
}
