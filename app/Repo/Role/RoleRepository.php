<?php

namespace App\Repo\Role;

use App\Model\Role;
use App\Repo\BaseRepository;

class RoleRepository extends BaseRepository implements RoleInterface
{
    public function __construct(Role $role)
    {
        $this->modelName = $role;
    }

    public function index($request)
    {

        $roles = $this->modelName
            ->when($request->filter != '', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->filter . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->paginate($roles);

    }

}
