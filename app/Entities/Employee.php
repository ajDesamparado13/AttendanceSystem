<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Employee extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'employees';
    protected $fillable = [
        'firstname', 'lastname', 'phone', 'user_id',
    ];

    public function user()
    {
        return $this->hasOne('App\Entities\User', 'id', 'user_id');
    }

}