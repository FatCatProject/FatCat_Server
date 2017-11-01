<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
	protected $table = 'foods';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_email',
		'food_name',
		'date_bought',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'picture',
	];

	public function user()
	{
		return $this->belongsTo('App\User', 'user_email', 'email');
	}

	public function foodboxes()
	{
		return $this->hasMany('App\Foodbox', 'food_id', 'id');
	}
}
