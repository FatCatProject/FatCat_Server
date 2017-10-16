<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{

    protected $table = 'cats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'cat_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'profile_picture',
    ];

    public function setFoodAllowanceAttribute($value)
    {
        $value = ($value >= 0) ? $value : 0;
        return $value;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function vetLogs()
    {
        return $this->hasMany('App\CatVetLog', 'user_email', 'user_email')->where('cat_name', '=', $this->cat_name);
    }

    public function cards()
    {
        return $this->hasMany('App\Card', 'cat_id', 'id');
    }

    public function catBreed()
    {
        return $this->belongsTo('App\CatBreed', 'cat_breed', 'breed_name');
    }
}
