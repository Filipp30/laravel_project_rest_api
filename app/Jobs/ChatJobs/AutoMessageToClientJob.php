<?php

namespace App\Jobs\ChatJobs;

use App\Events\NewMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoMessageToClientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $chat_session;
    private $message;

    public function __construct($chat_session,$message){
        $this->chat_session = $chat_session;
        $this->message = $message;
    }

    public function handle(){
        $time_stamp = gmdate("Y-m-d H:i:s");
        event(new NewMessage($this->chat_session,'Admin',$this->message,$time_stamp));
    }
}
