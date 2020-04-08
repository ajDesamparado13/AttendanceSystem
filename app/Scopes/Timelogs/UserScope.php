<?php

namespace App\Scopes\Timelogs;

use App\Entities\Menu;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class UserScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $roles = Auth::User()->roles->pluck('id');
        $menus = Menu::whereHas('roles', function ($q) use ($roles) {
            $q->whereIn('roles.id', $roles);
        })->get()->pluck('name')->values()->all();

        if (!in_array('Timelogs', $menus)) {
            $builder->where('causer_id', Auth::User()->id);
        }

    }
}