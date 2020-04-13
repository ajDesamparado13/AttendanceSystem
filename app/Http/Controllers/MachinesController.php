<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MachineCreateRequest;
use App\Http\Requests\MachineUpdateRequest;
use App\Repositories\MachineRepository;
use App\Validators\MachineValidator;

/**
 * Class MachinesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MachinesController extends Controller
{
    /**
     * @var MachineRepository
     */
    protected $repository;

    /**
     * @var MachineValidator
     */
    protected $validator;

    /**
     * MachinesController constructor.
     *
     * @param MachineRepository $repository
     * @param MachineValidator $validator
     */
    public function __construct(MachineRepository $repository, MachineValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $machines = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $machines,
            ]);
        }

        return view('machines.index', compact('machines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MachineCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MachineCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $machine = $this->repository->create($request->all());

            $response = [
                'message' => 'Machine created.',
                'data'    => $machine->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
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
        $machine = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $machine,
            ]);
        }

        return view('machines.show', compact('machine'));
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
        $machine = $this->repository->find($id);

        return view('machines.edit', compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MachineUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MachineUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $machine = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Machine updated.',
                'data'    => $machine->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Machine deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Machine deleted.');
    }
}
