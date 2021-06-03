<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller{


    public function redirectFacebook(){
        return Socialite::driver('facebook')->redirect();
    }


    public function facebookCallBack(){
        try {
            $user = Socialite::driver('facebook')->user();
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

            return redirect('/welcome');

        }catch (Exception $e){
            dd($e->getMessage());
        }
    }




}
