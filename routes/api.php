<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;


Route::post('/registration',[RegisterController::class,'registration']);
Route::post('/login',[LoginController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/testing_request','App\Http\Controllers\TestController@testing_request');
    Route::post('/logout',[LoginController::class,'logout']);

});

Route::middleware(['auth:sanctum','admin'])->group(function (){

});

