<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Attachment extends Model
{
    protected $guarded = [];
    protected $table = 'attachment';

    public function author()
    {
        return $this->belongsTo('App\News','id');
    }

}