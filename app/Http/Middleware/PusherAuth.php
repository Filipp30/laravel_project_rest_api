<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PusherAuth
{

    public function handle(Request $request, Closure $next){
//        $socket_id = $request->request->get("socket_id");
//        $channel_name = $request->request->get("channel_name");
//        $jwt_token = $request->headers->headers["authorization"][0];
//        return $next($request);
    }
}
