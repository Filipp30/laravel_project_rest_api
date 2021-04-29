<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatWaitingList;
use Illuminate\Http\Request;

class ChatController extends Controller{


    public function get_chat_session_waiting_list(){
        return ChatWaitingList::with('user')->get();
    }

    public function auto_response_welcome_message($user,$session){

        $message ='Hey '.$user->name.'. Notification that you are in the chatroom has been sent to Admin. Please wait...';
        $time_stamp = gmdate("Y-m-d H:i:s");
        $admin = ["name"=>"Admin"];
        event(new NewMessage($session,$admin,$message,$time_stamp));
    }


}
