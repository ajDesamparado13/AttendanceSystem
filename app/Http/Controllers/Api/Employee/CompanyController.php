<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Company;

class CompanyController extends Controller
{
    
    public function index(){

        return response()->json([
            'companies' => Company::all()
        ]);
    }
}
