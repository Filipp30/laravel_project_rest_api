<?php

namespace App\Console\Commands;

use App\Http\Controllers\Notification\NotificationController;
use Illuminate\Console\Command;

class testingCommand extends Command
{

    protected $signature = 'testing_command';


    protected $description = 'testing command';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $data = 'This is testing notification from testingCommand. Time : '.time();
       $notifi = new NotificationController();
       $notifi->sendEmailNotification('filipp-tts@outlook.com',$data);
    }
}
