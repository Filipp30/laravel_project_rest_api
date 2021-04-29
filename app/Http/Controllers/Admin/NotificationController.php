<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\CurlClient;
use Twilio\Rest\Client;


class NotificationController extends Controller{

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
