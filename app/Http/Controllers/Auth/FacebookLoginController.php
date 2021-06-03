<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller{


    public function auth_redirect_fb(){
        return response(
          [
              'auth'=>Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl()
          ],
          201
        );
    }


    public function fb_login_call_back(){
//        try {
//            $user = Socialite::driver('facebook')->user();
//            $isUser = User::query()->where('fb_id', $user->id)->first();

//            if ($isUser){
//                return response([
//                    'message'=>'user facebook in DB exist',
//                    'user_info_fb'=>$user,
//                    'user_info_db'=>$isUser
//                ],201);
//            }else{
//                return response([
//                    'message'=>'user not exist in us DB',
//                    'user_fb_info'=>$user,
//                    'password'=> encrypt('user')
//                ],201);
//            }

//            return redirect('/user');

//        }catch (Exception $e){
//            dd($e->getMessage());
//        }
        $user =  Socialite::driver('google')->stateless()->user();

        return view('user',['user'=>$user->getId()]);

    }




}
