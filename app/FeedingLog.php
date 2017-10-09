<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedingLog extends Model
{
    protected $table = 'feeding_logs';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'foodbox_id',
        'card_id',
        'feeding_id',
        'open_time',
        'close_time',
        'start_weight',
        'end_weight',
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

    public function card()
    {
        return $this->belongsTo('App\Card', 'card_id', 'card_id');
    }

    public function foodbox()
    {
        return $this->belongsTo('App\Foodbox', 'foodbox_id', 'foodbox_id');
    }
}
