<?php

namespace App\Policies\Users;

use App\Entities\User;
use App\Traits\Policy\AccessablePolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization, AccessablePolicy;

    public function index(User $user)
    {
        return $this->accessable('Users');
    }

}