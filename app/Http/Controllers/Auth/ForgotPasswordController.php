<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller{

    public function forgot(){
        $credentials = request()->validate(['email' => 'required|email']);
        $user = User::where('email',$credentials['email'])->first();
        if (! $user){
            return response([
                'message'=>'User not exist'
            ],401);
        }
        Password::sendResetLink($credentials);
        return response()->json(["message" => 'Reset password link sent on your email id.']);
    }

    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);
        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });
        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["message" => "Invalid token provided"], 400);
        }
        return response()->json(["message" => "Password has been successfully changed"]);
    }

}
