<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'firstname', 'lastname', 'phone', 'user_id',
    ];

    public function user()
    {
        return $this->hasOne('App\Model\User', 'id', 'user_id');
    }

}