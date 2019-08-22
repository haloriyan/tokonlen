<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderan extends Model
{
    protected $table = 'orderan';
    protected $primaryKey = 'idorder';

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
