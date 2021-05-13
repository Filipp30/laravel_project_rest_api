<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller{



    public function add_file(Request $request){

        $res = Storage::disk('local')->put('storage/images',$request->file('image'));
        return response($res);
    }

    public function get_file(){
//        return response()->download(storage_path("app/storage/4FPqWri6i2paOrJB18nSYnlaC5t7mpR1ao7mE6pA.jpg"));

    }

    public function delete_file(){

        return Storage::disk('local')->delete('storage/images/lKLPf5ETnKLrrDNFPKoeNyrryRApmAIWfOzhjmR2.jpg');
    }

    public function get_dir(){
//        return Storage::files('storage/');
//        return Storage::allFiles();
//        return Storage::directories();
        return Storage::allDirectories();
    }





}
