<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use FrancescoMalatesta\LaravelReactions\Traits\Reacts;
use Hootlex\Friendships\Traits\Friendable;

class User extends Authenticatable
{
    use Notifiable;
    use Reacts;
    use Friendable;

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

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
