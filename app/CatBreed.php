<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatBreed extends Model
{
    protected $table = 'cat_breeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'breed_name',
        'link',
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function cats()
    {
        return $this->hasMany('App\Cat', 'cat_breed', 'breed_name');
    }
}
