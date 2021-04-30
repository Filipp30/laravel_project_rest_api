<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\NotificationAdminList;
use Illuminate\Support\Facades\Mail;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\CurlClient;
use Twilio\Rest\Client;


class NotificationController extends Controller{

    //first check if admin enabled the notification methods

    public function sendNotificationToAdmins($requested_user,$new_chat_session){

         $list = NotificationAdminList::with('user')
             ->where('sms_new_chat_session_created','=','1')
             ->orWhere('email_new_chat_session_created','=','1')
             ->get();


        $data_response_testing = [];
         foreach ($list as $enabled){

             if ($enabled->sms_new_chat_session_created){
                 $data_response_testing[]=$enabled->user->name.' -sms vklutjin';
             }
             if ($enabled->email_new_chat_session_created){
                 $data_response_testing[]=$enabled->user->name.' -email vklutjin';
             }
         }
        return response($data_response_testing);



//        $notification_message = 'name: '.$requested_user->name.'--session: '.$new_chat_session;
//        $response_sms_sending = $notification_to_admin->sendSmsNotification('+32483708133',$notification_message);
//
//        $email_to = ["email"=>"filipp-tts@outlook.com"];
//        $data = ["user_name"=>$this->user->name, "user_email"=>$this->user->email, "session"=>$this->session];
//        $response_email_sending = $notification_to_admin->sendEmailNotification($email_to,$data);


//        return response($data);
    }


    public function sendSmsNotification($to,$message){
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $twilioNumber = env('TWILIO_NUMBER');
        $client = new Client($accountSid, $authToken);
        $curlOptions = [ CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false];
        $client->setHttpClient(new CurlClient($curlOptions));

        try {
            $client->messages->create(
                $to,
                [
                    'from' => $twilioNumber,
                    'body' => $message
                ]
            );
            return true;
        }catch (TwilioException $e){
            return $e;
        }
    }

    public function sendEmailNotification($to,$data){
        if (!filter_var($to['email'],FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $email = $to['email'];
        $subject = "Notification Email";

        Mail::send('./email_templates/notification_new_chat_session_created',$data,function($message) use ($email, $subject){
            $message->to($email);
            $message->subject($subject);
            $message->cc('filipp-tts@outlook.com');
        });
        return true;
    }

}
