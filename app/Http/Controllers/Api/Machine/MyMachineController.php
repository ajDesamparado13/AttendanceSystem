<?php

namespace App\Http\Controllers\Api\Machine;

use App\Http\Controllers\Controller;
use App\Http\Requests\MachineCreateRequest;
use App\Repositories\MachineRepository;

class MyMachineController extends Controller
{
    public function __construct(MachineRepository $repository)
    {
        $this->repository = $repository;
    }

    public function macAddress()
    {
        $request = app()->make('request');
        $macAddress = null;
        $machine = $this->repository->where('employee_id', $request->employee_id)
            ->first();
        if ($machine) {
            $macAddress = $machine->mac_address;
        }
        return response()->json([
            'macAddress' => $macAddress,
        ]);
    }

    public function store(MachineCreateRequest $request)
    {
        /****
         * Can't use updateOrCreate(array $attributes, array $values = [])
         * using foreign key
         * **/

        $machine = $this->repository->where('employee_id', $request->employee_id)
            ->first();
        if ($machine) {
            $machine->update($request->all());
        } else {
            $this->repository->create($request->all());
        }

        return response()->Json([
            'machine' => $machine,
        ]);
    }
}