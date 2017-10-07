<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCard extends Model
{
    protected $table = 'admin_cards';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }
}
