<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\NotificationAdminList;
use App\Services\Contracts\TwilioSmsContract;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller{


    // Send notification to ALL Admins when new chat session is created
    public function sendNotificationToAdmins($requested_user,$new_chat_session){

         $enabled_notifications_list = NotificationAdminList::with('user')
         ->where('sms_new_chat_session_created','=','1')
         ->orWhere('email_new_chat_session_created','=','1')
         ->get();

         $log_admins_notificator = [];

         $client_information_for_email_template = [
             "user_name"=>$requested_user->name,
             "user_email"=>$requested_user->email,
             "session"=>$new_chat_session,
             "date_time"=>date("Y-m-d H:i:s"),
         ];
         $client_information_for_sms_template = 'name: '.$requested_user->name.'--session: '.$new_chat_session;

         foreach ($enabled_notifications_list as $enabled){
             if ($enabled->sms_new_chat_session_created){
                 $status = $this->sendSmsNotification($enabled->user->phone_number,$client_information_for_sms_template);
                 $log_admins_notificator[] = $enabled->user->name.' sms_send_status : '.$status;
             }
             if ($enabled->email_new_chat_session_created){
                 $status = $this->sendEmailNotification($enabled->user->email,$client_information_for_email_template);
                 $log_admins_notificator[] = $enabled->user->name.' email_send_status : '.$status;
             }
         }

         logs()->info('NotificationController->sendNotificationToAdmins:
         requested user: '.$requested_user->name.'--'.$requested_user->email.' .
         send to : '.implode(',',$log_admins_notificator));
    }

    public function sendSmsNotification($to,$message, TwilioSmsContract $twilioSmsContract){
        $twilioSmsContract->send($to,$message);
    }

    public function sendEmailNotification($to,$data){
        if (!filter_var($to,FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $subject = "Notification: new chat session was created";
        Mail::send('./email_templates/notification_new_chat_session_created',$data,function($message) use ($to, $subject){
            $message->to($to);
            $message->subject($subject);
        });
        return true;
    }
}
