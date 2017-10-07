<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function foodboxes()
    {
        return $this->hasMany('App\Foodbox', 'food_id', 'id');
    }
}
