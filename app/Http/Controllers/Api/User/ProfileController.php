<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\UserRepository;
use Auth;

class ProfileController extends Controller
{
    public function __construct(UserRepository $repository, EmployeeRepository $employee)
    {
        $this->repository = $repository;
        $this->employee = $employee;
    }
    public function edit()
    {
        $user = $this->repository->where('id', Auth::User()->id)->with(['roles'])->first();
        if (request()->wantsJson()) {

            return response()->json([
                'user' => $user,
            ]);
        }
        return view('users.edit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $this->repository->update($request->all(), Auth::User()->id);
        $employee = $this->employee->where('user_id', Auth::User()->id)->update([
            'firstname' => $request->employee['firstname'],
            'lastname' => $request->employee['lastname'],
        ]);

        $response = [
            'message' => 'User updated.',
            'data' => $user->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }
    }

    public function changePassword(PasswordRequest $request)
    {
        $user = $this->repository->where('id', Auth::User()->id)->first()->update([
            'password' => $request->password,
        ]);
        return response()->json([
            'success' => true,
        ]);
    }
}