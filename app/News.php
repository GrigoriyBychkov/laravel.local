<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function attachment()
    {
        return $this->hasMany('App\Attachment');
    }

}