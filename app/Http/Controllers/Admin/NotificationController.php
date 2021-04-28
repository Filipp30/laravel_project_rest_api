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

    public function sendEmailNotification($to,$message){

//        try {
//            Mail::send('./email_templates/user_contact_email',$validated,function($message) use ($subject){
//                $message->to('filipp-tts@outlook.com','to web developer');
//                $message->subject($subject);
//                $message->cc('filipp-tts@outlook.com');
//            });
//            return response([
//                'message'=>'Email send successfully'
//            ],201);
//        }catch (\Exception $error){
//            return response([
//                'message'=>'Failed to send your email',
//                'error'=>$error
//            ],401);
//        }
    }

}
