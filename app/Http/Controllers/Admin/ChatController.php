<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatWaitingList;
use Illuminate\Http\Request;

class ChatController extends Controller{


    public function get_chat_session_waiting_list(){
        return ChatWaitingList::with('user')->get();
    }


}
