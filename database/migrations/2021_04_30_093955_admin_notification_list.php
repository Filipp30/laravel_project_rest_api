<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdminNotificationList extends Migration
{

    public function up()
    {
        Schema::create('admin_notification_list',function (Blueprint $table){
            $table->id();
            $table->foreignId('admin_id')->references('id')->on('users');
            $table->boolean('sms_new_chat_session_created')->default(false);
            $table->boolean('email_new_chat_session_created')->default(false);

        });
    }


    public function down()
    {
        Schema::dropIfExists('admin_notification_list');
    }
}
