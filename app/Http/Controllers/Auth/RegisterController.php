<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller{

    public function registration(Request $request){
        $user_inputs = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string','confirmed','min:8'],
        ]);
        $user = User::create([
            'name' => $user_inputs['name'],
            'email' => $user_inputs['email'],
            'password' => Hash::make($user_inputs['password']),
        ]);
        $token = $user->createToken('jwt_token')->plainTextToken;
        $response = [
            'user'=> $user,
            'token'=>$token
        ];
        return response($response, 201);
    }






}
