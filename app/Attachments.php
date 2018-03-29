<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Attachments extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo('App\News','id');
    }

}