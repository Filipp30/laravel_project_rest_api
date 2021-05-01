<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatWaitingList;

class ChatController extends Controller{

    public function get_chat_session_waiting_list(){
        return ChatWaitingList::with('user')->get();
    }
}
