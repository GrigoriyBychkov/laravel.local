<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Auth;


class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    public function userNotifications()
    {
        $user = User::find(1);

        foreach ($user->notifications as $notification) {
            echo $notification->type;
        }
    }

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

    protected $dates = ['deleted_at'];


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
