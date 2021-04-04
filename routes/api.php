<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/testing_request','App\Http\Controllers\TestController@testing_request');

});


Route::post('/registration',[RegisterController::class,'registration']);
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout']);
