<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chatting';
    protected $primaryKey = 'idchat';
    

    protected $fillable = ['idchat','user_id','message','sender'];

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
