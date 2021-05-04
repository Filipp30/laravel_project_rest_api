<?php

namespace App\Observers;

use App\Jobs\ModelNotificationJobs\NewUserCreatedNotificationJob;
use App\Models\User;
use App\Notifications\NewUserCreatedNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{

    public $afterCommit = true;

    public function created(User $user){
        NewUserCreatedNotificationJob::dispatch($user);
        logs()->info('UserObserver called ---> redirect ot job');
    }


    public function updated(User $user)
    {
        //
    }


    public function deleted(User $user)
    {
        //
    }


    public function restored(User $user)
    {
        //
    }


    public function forceDeleted(User $user)
    {
        //
    }
}
