<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//    public function is_admin()
//    {
//        $role = $this->role;
//        if($role == '1')
//        {
//            return true;
//        }
//        return false;
//    }
    public function isAdmin()
    {
        $user = Auth::user();
        $role = $user->role;
        if ($role == 0) {
           return false;
        } else {
            return true;
        }
    }

    public function news()
    {
        return $this->hasMany('App\News','author_id');
    }
}
