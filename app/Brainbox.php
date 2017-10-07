<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brainbox extends Model
{

    protected $table = 'brainboxes';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

}
