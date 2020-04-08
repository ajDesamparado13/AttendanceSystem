<?php

namespace App\Http\Controllers\Api\Machine;

use App\Http\Controllers\Controller;
use Auth;

class EmployeeController extends Controller
{

    public function employeeId()
    {

        return response()->json([
            'employeeId' => Auth::User()->employee->id,

        ]);
    }
}