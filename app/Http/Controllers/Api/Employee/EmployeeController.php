<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Repo\Employee\EmployeeInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $employee;
    public function __construct(EmployeeInterface $employee)
    {

        $this->employee = $employee;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'employees' => $this->employee->index(app()->make('request')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {

        $this->employee->store($request);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $e = $this->employee->where('id', $id)
            ->with(['user.roles'])
            ->first();
        $array = $e->only('id', 'company_id', 'firstname', 'lastname', 'phone');
        $array['email'] = $e->user['email'];
        $array['role_id'] = $e->user->roles->pluck('id');

        return response()->json([
            'employee' => $array,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $this->employee->repoUpdate($request);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->employee->where('id', $id)->first()->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
