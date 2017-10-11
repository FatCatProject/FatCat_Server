<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brainbox extends Model
{

    protected $table = 'brainboxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'brainbox_id',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

}
