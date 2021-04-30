<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdminList extends Model
{
    use HasFactory;
    protected $table = 'admin_notification_list';


    public function user(){
        return $this->BelongsTo(User::class,'admin_id','id');
    }
}
