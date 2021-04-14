<?php

namespace App\Http\Controllers\Contact;
use App\Events\ChatSessionRemoved;
use App\Events\NewChatSessionCreated;
use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatWaitingList;
use App\Models\ContactChat;
use Illuminate\Http\Request;


class ContactChatController extends Controller{
    public function create_new_chat_session(){
        //first update database before call Event !!! from Vue call api for update local WaitList
        $user = auth()->user();
        $session = time();
        $create_new_chat = new ChatWaitingList();
        $create_new_chat->user_id = $user->getAuthIdentifier();
        $create_new_chat->session = $session;
        $create_new_chat->save();
        event(new NewChatSessionCreated($session));
        return $session;
    }

    public function get_chat_session_messages(Request $request_data){
        $session=$request_data->get('chat_session');
        return ContactChat::with('user')
        ->where('session','=',$session)
        ->orderBy('created_at','asc')
        ->get();
    }

    public function addMessage(Request $request_data){
        $user = auth()->user();
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
        return response([
            'message'=>'message send successfully'
        ],201);
    }

    public function remove_chat_session(Request $request_data){
        $session = $request_data->get('chat_session');
        event(new ChatSessionRemoved($session));
        ChatWaitingList::query()->where('session','=',$session)->delete();
        ContactChat::query()->where('session','=',$session)->delete();
    }



}
