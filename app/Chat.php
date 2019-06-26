<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chatting';
    protected $primaryKey = 'idchat';

    protected $fillable = ['idchat','user_id','message','sender'];
}
