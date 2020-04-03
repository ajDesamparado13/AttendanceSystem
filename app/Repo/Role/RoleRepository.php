<?php

namespace App\Repo\Role;

use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository implements RoleInterface
{

    public function model()
    {
        return "App\\Post";
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