<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{

    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isAdmin !=1){
            return response(['message'=>'is not admin']);
        }
        return $next($request);
    }
}
