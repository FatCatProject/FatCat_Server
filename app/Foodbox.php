<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodbox extends Model
{

    protected $table = 'foodboxes';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function cards()
    {
        return $this->hasMany('App\Card', 'foodbox_id', 'foodbox_id');
    }

    public function feedingLogs()
    {
        return $this->hasMany('App\FeedingLog', 'foodbox_id', 'foodbox_id');
    }

    public function food()
    {
        return $this->belongsTo('App\Food', 'food_id', 'id');
    }
}
