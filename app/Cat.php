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

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function vetLogs()
    {
        return $this->hasMany('App\CatVetLog', 'cat_id', 'id');
    }

    public function cards()
    {
        return $this->hasMany('App\Card', 'cat_id', 'id');
    }
}
