<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingLog extends Model
{
    protected $table = 'shopping_logs';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }
}
