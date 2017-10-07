<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function foodbox()
    {
        return $this->belongsTo('App\Foodbox', 'foodbox_id', 'foodbox_id');
    }

    public function feedingLogs()
    {
        return $this->hasMany('App\FeedingLog', 'card_id', 'card_id');
    }
}
