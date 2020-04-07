<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Auth;

/**
 * Class Menu.
 *
 * @package namespace App\Entities;
 */
class Menu extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'menus';
    protected $fillable = [
        'name'
    ];

    protected $appends = ['path'];

    public function roles()
    {
        return $this->belongsToMany('App\Entities\Role')->withTimestamps();
    }

    public function getPathAttribute(){

        return '/dashboard/'. str_slug($this->name, '-');
    }

    public function scopeConstraintRoles($q, $roles){
        
        return $q->whereHas('roles', function($q) use ($roles) {
            $q->whereIn('role_id', $roles);
        })
        ->get()
        ->map(function($v){
            return [
                'name' => $v->name,
                'path' => $v->path
            ];
        })->values()->all();
    }

}