<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

        return response()->json([
            'roles' => $this->repository->all(),
        ]);
    }
}