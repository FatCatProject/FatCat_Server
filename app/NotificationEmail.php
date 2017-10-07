<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationEmail extends Model
{
    protected $table = 'notification_emails';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_email', 'email');
    }
}
