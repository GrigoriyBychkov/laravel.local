<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function message()
    {
        $this->hasMany('App\Message');
    }

    public function author()
    {
        $this->belongsTo('App\User');
    }
}
