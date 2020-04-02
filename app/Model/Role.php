<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

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
