<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactEmail extends Controller{

    public function send_email(Request $request_data){

        $validated = $request_data->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'subject' => 'required|string|max:50',
            'user_message' => 'required|string|max:500',
        ]);

        $subject = $validated['subject'];
        try {
            Mail::send('./email_templates/user_contact_email',$validated,function($message) use ($subject){
                $message->to('filipp-tts@outlook.com','to web developer');
                $message->subject($subject);
                $message->cc('filipp-tts@outlook.com');
            });
            return response([
                'message'=>'Email send successfully'
            ],201);
        }catch (\Exception $error){
            return response([
                'message'=>'Failed to send your email',
                'error'=>$error
            ],401);
        }
    }
}
