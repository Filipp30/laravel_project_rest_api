<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatWaitingList extends Model
{
    use HasFactory;

    protected $table = 'chat_waiting_lists';
    public $timestamps = false;

    public function user(){
        return $this->BelongsTo(User::class,'user_id','id');
    }

}
