<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03.04.2018
 * Time: 16:46
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected function subCategories()
    {
        return $this->hasMany('App\Category');
    }

    public function parent()
    {
        return $this->belongsTo('App\Category' ,'category_id');
    }
}