<?php

namespace App\Http\Controllers\Contact;
use App\Events\ChatSessionRemoved;
use App\Events\NewChatSessionCreated;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatWaitingList;
use App\Models\ContactChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactChatController extends Controller{
    public function create_new_chat_session(){
        //first update database before call Event !!! from Vue call api for update local WaitList
        $user = Auth::user();
        $session = time();
        $call = new ChatWaitingList();
        $call->user_id = $user->getAuthIdentifier();
        $call->session = $session;
        $call->save();
        event(new NewChatSessionCreated($session));
        return $session;
    }

    public function getMessages(Request $request_data){
        $session=$request_data->get('chat_session');
        return ContactChat::with('user')
        ->where('session','=',$session)
        ->orderBy('created_at','asc')
        ->get();
    }

    public function addMessage(Request $request_data){
        $user = Auth::user();
        $chat_session = $request_data->get('chat_session');
        $user_name = $user->name;
        $user_message = $request_data->get('input_message');
        $time_stamp = gmdate("Y-m-d H:i:s");
        event(new NewMessage($chat_session,$user_name,$user_message,$time_stamp));
        $chat = new ContactChat();
        $chat->user_id = $user->getAuthIdentifier();
        $chat->session = $chat_session;
        $chat->message = $user_message;
        $chat->created_at = $time_stamp;
        $chat->save();
    }

    public function remove_chat_session(Request $request_data){
        $session = $request_data->get('chat_session');
        event(new ChatSessionRemoved($session));
        ChatWaitingList::query()->where('session','=',$session)->delete();
        ContactChat::query()->where('session','=',$session)->delete();
    }



}
