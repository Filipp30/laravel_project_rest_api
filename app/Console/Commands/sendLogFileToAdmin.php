<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendLogFileToAdmin extends Command{

    protected $signature = 'sendLogMailToAdmin';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        logs()->info('create log on : '.date("Y-m-d H:i:s").'Sending with email to admin');
        $data = ["date_time"=>date("Y-m-d H:i:s")];
        $subject = "Log file from Server";

        Mail::send('./email_templates/log_file_to_admin',$data,function($message) use ($subject){
            $message->attach('./storage/logs/laravel.log');
            $message->to('filipp-tts@outlook.com');
            $message->subject($subject);
        });
    }
}
