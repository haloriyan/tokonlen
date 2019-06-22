<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Review extends Model
{
    protected $table = "reviews";
    protected $primaryKey = "idreview";
    // protected $foreignKey = "user_id";

    public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
