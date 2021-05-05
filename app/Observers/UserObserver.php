<?php

namespace App\Observers;

use App\Jobs\ModelNotificationJobs\NewUserCreatedNotificationJob;
use App\Models\User;

class UserObserver
{

    public $afterCommit = true;

    public function created(User $user){
        NewUserCreatedNotificationJob::dispatch($user);
    }


    public function updated(User $user)
    {

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
