<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'product_name',
        'weight',
        'price',
        'is_food',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'picture',
        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

}
