<?php

namespace App\Jobs\ChatJobs;

use App\Http\Controllers\Notification\NotificationController;
use Illuminate\Bus\Queueable;
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
        $notification_to_admins = new NotificationController();
        $notification_to_admins->sendNotificationToAdmins($this->user,$this->session);
    }
}
