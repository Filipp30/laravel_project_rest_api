<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactChat extends Model
{
    use HasFactory;

    protected $table = 'contact_chats';
    public $timestamps = false;

    public function user(){
        return $this->BelongsTo(User::class,'user_id','id');
    }
}
