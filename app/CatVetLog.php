<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatVetLog extends Model
{
    protected $table = 'cats_vet_logs';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function cat()
    {
        return $this->belongsTo('App\Cat', 'cat_id', 'id');
    }
}
