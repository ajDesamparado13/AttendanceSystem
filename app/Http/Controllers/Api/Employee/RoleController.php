<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Model\Role;

class RoleController extends Controller
{

    public function index()
    {
        return response()->json([
            'roles' => Role::all(),
        ]);
    }
}
