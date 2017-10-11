<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    protected $table = 'veterinarians';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'clinic_name',
        'vet_name',
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
