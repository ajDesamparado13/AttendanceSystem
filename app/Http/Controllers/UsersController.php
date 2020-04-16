<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\EmployeeRepository;
use App\Repositories\UserRepository;
use App\Traits\Obfuscate\Optimuss;
use App\Validators\UserValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    use Optimuss;
    /**
     * @var UserRepository
     */
    protected $repository;
    protected $employee;
    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(EmployeeRepository $employee, UserRepository $repository, UserValidator $validator)
    {
        $this->employee = $employee;
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', User::class);
        $request = app()->make('request');

        $users = $this->repository->with(['employee'])
            ->paginate($limit = $request->limit, $columns = ['*']);

        return response()->json([
            'data' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {

        try {

            $user = $this->repository->create($request->all());
            $user = $this->repository->where('id', $user->id)->first();
            $user->roles()->attach($user->id, [
                'user_id' => $user->id,
                'role_id' => 2,
            ]);
            $user->employee()->create($request->all());
            $response = [
                'message' => 'User created.',
                'data' => $user->toArray(),
            ];

            $this->repository->activationCode();

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->authorize('index', User::class);
        $user = $this->repository->where('id', $this->removeStringDecode($id))->with(['roles'])->first();
        if (request()->wantsJson()) {

            return response()->json([
                'user' => $user,
                'roles' => $user->roles->pluck('id'),
            ]);
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->authorize('index', User::class);
        try {

            $user = $this->repository->update($request->all(), $this->removeStringDecode($id));
            $employee = $this->employee->where('user_id', $user->id)->update([
                'firstname' => $request->employee['firstname'],
                'lastname' => $request->employee['lastname'],
            ]);
            $user = $this->repository->where('id', $this->removeStringDecode($id))->first();
            $user->roles()->sync($request->roleIds);

            $response = [
                'message' => 'User updated.',
                'data' => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('index', User::class);
        $deleted = $this->repository->delete($this->removeStringDecode($id));

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }

    public function changePassword(PasswordRequest $request)
    {
        $user = $this->repository->where('id', $request->id)->first()->update([
            'password' => $request->password,
        ]);
        return response()->json([
            'success' => true,
        ]);
    }
}