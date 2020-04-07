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

    protected $appends = [
        'employeeName',
    ];

    public function AauthAcessToken()
    {
        return $this->hasMany('App\Entities\OauthAccessToken');
    }

    public function employee()
    {
        return $this->hasOne('App\Entities\Employee', 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Entities\Role', 'role_user', 'user_id', 'role_id')->withTimestamps();

    }

    public function setPasswordAttribute($value)
    {
        if (!$value) {
            $value = "password"; // default password
        }
        if (strlen($value) >= 60 && preg_match('/^\$2y\$/', $value)) {
            return $this->attributes['password'] = $value;
        }
        $this->attributes['password'] = Hash::make($value);
    }

    public function getEmployeeNameAttribute()
    {
        return $this->employee->lastname . ', ' . $this->employee->firstname;
    }

}