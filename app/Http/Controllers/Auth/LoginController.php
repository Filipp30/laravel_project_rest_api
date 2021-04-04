<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum;
class LoginController extends Controller{

    public function login(){



    }
    public function logout(){
//        return User::all()->where('id','=',1)->currentAccessToken();
//        return User::all()->tokens();
        return User::find(1)->tokens()->where('id',1)->delete();


    }

}
