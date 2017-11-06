<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatVetLog extends Model
{
    protected $table = 'cats_vet_logs';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_email',
        'cat_name',
        'visit_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'prescription_picture',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }

    public function cat()
    {
        return $this->belongsTo('App\Cat', 'user_email', 'user_email')->where('cat_name', '=', $this->cat_name);
    }
}
