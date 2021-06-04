<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function auth_redirect_google(){
        return response(
            [
                'auth'=>Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
            ],
            201
        );
    }

    public function google_login_call_back(){

        $user =  Socialite::driver('google')->stateless()->user();
        dd($user);

    }
}
