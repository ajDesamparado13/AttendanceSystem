<?php

namespace App\Repo\Employee;

use App\Model\Employee;
use App\Model\User;
use App\Repo\BaseRepository;
use Hash;

class EmployeeRepository extends BaseRepository implements EmployeeInterface
{
    public function __construct(Employee $employee)
    {

        $this->modelName = $employee;
    }

    public function index($request)
    {

        $filter = explode(' ', $request->filter);
        $employees = $this->modelName
            ->when(count($filter) > 0, function ($q) use ($filter) {
                $q->where('lastname', 'like', '%' . $filter[0] . '%');
            })
            ->when(count($filter) > 1, function ($q) use ($filter) {
                $q->where('firstname', 'like', '%' . $filter[1] . '%');
            })
            ->with(['company', 'user.roles'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($v) {
                return [
                    'id' => $v->id,
                    'company' => $v->company['name'],
                    'name' => $v->lastname . ', ' . $v->firstname,
                    'email' => $v->user['email'],
                    'phone' => $v->phone,
                    'roles' => implode(',', collect($v->user['roles'])->pluck('name')->values()->all()),
                ];
            });

        return $this->paginate($employees);

    }

    public function store($request)
    {

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make(str_random(6)),
        ]);

        $user = User::where('id', $user->id)->first();
        $user->roles()->sync($request->role_id);

        $newRequest = $request->all();
        $newRequest['user_id'] = $user->id;
        $this->create($newRequest);

    }

    public function repoUpdate($request)
    {

        $employee = $this->where('id', $request->id)
            ->first();
        $user = User::where('id', $employee->user_id)->first();
        $user->roles()->sync($request->role_id);
        $employee->update($request->all());

    }

}
