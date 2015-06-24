<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'about'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //Return articles owned by this user
    public function articles() {
        return $this->hasMany('App\Article');
    }

    //Return roles associated with this user
    public function roles() {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    //Return comments posted by this user
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    //Returns the username with the first letter uppercase and the rest lowercase
    public function getCapitalNameAttribute() {
        return ucfirst($this->name);
    }
}
