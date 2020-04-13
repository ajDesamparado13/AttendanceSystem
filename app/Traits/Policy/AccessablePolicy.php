<?php

namespace App\Traits\Policy;

use App\Entities\Menu;
use Auth;
trait AccessablePolicy
{

    public function accessable($menu)
    {

        $roles = Auth::User()->roles->pluck('id')->values()->all();
        $menus = collect(Menu::constraintRoles($roles))->pluck('name')->values()->all();
        if (in_array($menu, $menus) === true) {
            return true;
        } else {
            return false;
        }

    }

}