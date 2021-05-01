<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable {

    use HasApiTokens,HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(){
        return $this->hasMany(ContactChat::class,'user_id','id');
    }

    public function notifications(){
        return $this->hasOne(NotificationAdminList::class,'admin_id','id');
    }

    public function waiting(){
        return $this->hasOne(ChatWaitingList::class,'user_id','id');
    }

}
