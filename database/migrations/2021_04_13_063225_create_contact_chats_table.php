<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactChatsTable extends Migration
{

    public function up()
    {
        Schema::create('contact_chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session');
            $table->integer('user_id');
//            $table->unsignedInteger('user_id');
            $table->text('message');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('contact_chats');
    }
}
