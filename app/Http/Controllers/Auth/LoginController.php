<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum;
class LoginController extends Controller{

    public function login(Request $request){

        $user_inputs = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string','min:8'],
        ]);
        $user = User::where('email',$user_inputs['email'])->first();
        if (! $user){
            return response([
                'message'=>'User not exist'
            ],401);
        }
        if (!Hash::check($user_inputs['password'],$user->password)){
            return response([
                'message'=>'Wrong credentials'
            ],401);
        }
        $token = $user->createToken('jwt_token');
        return $token;
    }

    public function logout(){
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response([
            'message'=>'logout successfully'
        ],201);
    }

}
