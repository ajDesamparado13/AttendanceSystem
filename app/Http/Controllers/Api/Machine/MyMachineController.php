<?php

namespace App\Http\Controllers\Api\Machine;

use App\Http\Controllers\Controller;
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
            $macAddress = $machine->MAC_address;
        }
        return response()->json([
            'macAddress' => $machine,
        ]);
    }
}