<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    protected $table = 'veterinarians';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }
}
