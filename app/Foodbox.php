<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodbox extends Model
{

    protected $table = 'foodboxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'food_id',
        'foodbox_id',
        'foodbox_name',
        'current_weight',
        'bowl_weight'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function setCurrentWeightAttribute($value)
    {
        $value = ($value >= 0) ? $value : 0;
        $this->attributes["current_weight"] = $value;
    }

    public function getCurrentWeightAttribute($value)
    {
        return $value - $this->bowl_weight;
    }

    public function setbowlWeightAttribute($value)
    {
        $value = ($value >= 0) ? $value : 0;
        $this->attributes["bowl_weight"] = $value;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function cards()
    {
        return $this->hasMany('App\Card', 'foodbox_id', 'foodbox_id');
    }

    public function feedingLogs()
    {
        return $this->hasMany('App\FeedingLog', 'foodbox_id', 'foodbox_id');
    }

    public function food()
    {
        return $this->belongsTo('App\Food', 'food_id', 'id');
    }
}
