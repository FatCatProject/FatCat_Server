<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedingLog extends Model
{
    protected $table = 'feeding_logs';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function card()
    {
        return $this->belongsTo('App\Card', 'card_id', 'card_id');
    }

    public function foodbox()
    {
        return $this->belongsTo('App\Foodbox', 'foodbox_id', 'foodbox_id');
    }
}
