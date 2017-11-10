<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'foodbox_id',
        'card_id',
        'card_name',
        'cat_id',
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

    public function foodbox()
    {
        return $this->belongsTo('App\Foodbox', 'foodbox_id', 'foodbox_id');
    }

    public function feedingLogs()
    {
        return $this->hasMany('App\FeedingLog', 'card_id', 'card_id');
    }

    public function cat()
    {
        return $this->belongsTo('App\Cat', 'cat_id', 'id');
    }
}
