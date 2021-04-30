<?php

namespace App\Jobs\ChatJobs;

use App\Http\Controllers\Admin\NotificationController;
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

        $notification_to_admin = new NotificationController();

        //sms notification to admin: new chat session was created
        $notification_message = 'name: '.$this->user->name.'--session: '.$this->session;
        $response_sms_sending = $notification_to_admin->sendSmsNotification('+32483708133',$notification_message);

        //sms notification to admin: new chat session was created
        $email_to = ["email"=>"filipp-tts@outlook.com"];
        $data = ["user_name"=>$this->user->name, "user_email"=>$this->user->email, "session"=>$this->session];
        $response_email_sending = $notification_to_admin->sendEmailNotification($email_to,$data);

        logs()->info('send notification(sms and/or email) to admin when new chat-session was created.
                response_sms_sending: '.$response_sms_sending.' -- response_email_sending: '.$response_email_sending
        );
    }
}
