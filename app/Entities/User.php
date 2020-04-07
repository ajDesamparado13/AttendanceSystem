<?php

namespace App\Entities;

use Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Authenticatable implements Transformable
{
    use HasApiTokens, Notifiable, TransformableTrait;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function AauthAcessToken()
    {
        return $this->hasMany('App\Entities\OauthAccessToken');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Entities\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();

    }

    public function setPasswordAttribute($value)
    {

        return $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

}