<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Role extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = [
        'name', 'desc',
    ];

    protected $appends = ['text', 'value'];

    public function getTextAttribute()
    {
        return $this->name;
    }
    public function getValueAttribute()
    {
        return $this->id;
    }
}