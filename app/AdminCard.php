<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCard extends Model
{
    protected $table = 'admin_cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'card_id',
        'card_name',
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
