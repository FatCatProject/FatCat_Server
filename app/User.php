<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getFirstNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    public function brainbox()
    {
        return $this->hasOne('App\Brainbox', 'user_email', 'email');
    }

    public function notificationEmails()
    {
        return $this->hasMany('App\NotificationEmail', 'user_email', 'email');
    }

    public function activeNotificationEmails()
    {
        return $this->hasMany('App\NotificationEmail', 'user_email', 'email')->where('active', '=', true);
    }

    public function veterinarians()
    {
        return $this->hasMany('App\Veterinarian', 'user_email', 'email');
    }

    public function shops()
    {
        return $this->hasMany('App\Shop', 'user_email', 'email');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'user_email', 'email');
    }

    public function shoppingLogs()
    {
        return $this->hasMany('App\ShoppingLog', 'user_email', 'email');
    }

    public function adminCards()
    {
        return $this->hasMany('App\AdminCard', 'user_email', 'email');
    }

    public function activeAdminCards()
    {
        return $this->hasMany('App\AdminCard', 'user_email', 'email')->where('active', '=', true);
    }

    public function cards()
    {
        return $this->hasMany('App\Card', 'user_email', 'email');
    }

    public function activeCards()
    {
        return $this->hasMany('App\Card', 'user_email', 'email')->where('active', '=', true);
    }

    public function catVetLogs()
    {
        return $this->hasMany('App\CatVetLog', 'user_email', 'email');
    }

    public function cats()
    {
        return $this->hasMany('App\Cat', 'user_email', 'email');
    }

    public function foodboxes()
    {
        return $this->hasMany('App\Foodbox', 'user_email', 'email');
    }

    public function feedingLogs()
    {
        return $this->hasMany('App\FeedingLog', 'user_email', 'email');
    }

    public function foods()
    {
        return $this->hasMany('App\Food', 'user_email', 'email');
    }

}
