<?php

namespace App\Jobs\ModelNotificationJobs;

use App\Notifications\NewUserCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;


class NewUserCreatedNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $user;

    public function __construct($user)
    {
       $this->user = $user;
    }


    public function handle()
    {
        Notification::send($this->user,new NewUserCreatedNotification());
        logs()->info('NewUserCreatedNotificationJob called --> redirect to NotificationsToAdmins');
    }
}
