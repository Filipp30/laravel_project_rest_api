<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pusher\Pusher;
class PusherAuthController extends Controller
{
    /**
     * @throws \Pusher\PusherException
     */
    public function pusher_authentication(Request $request){
        $socket_id = $request->request->get("socket_id");
        $thePusher = new Pusher('8a34625906a44e573ba7','f47f12dccf48e6e0286a','1169667',array('cluster'=>'eu'));
        return response($thePusher->socket_auth('private-my-channel', $socket_id),200) ;
    }
}
