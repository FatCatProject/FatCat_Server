<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function vetLogs()
    {
        return $this->hasMany('App\CatVetLog', 'cat_id', 'id');
    }
}
