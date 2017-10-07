<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }
}
