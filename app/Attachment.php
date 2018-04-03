<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Attachment extends Model
{
    protected $guarded = [];
    protected $table = 'attachments';

    public function author()
    {
        return $this->belongsTo('App\News','id');
    }

}