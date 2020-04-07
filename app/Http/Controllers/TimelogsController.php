<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TimelogCreateRequest;
use App\Http\Requests\TimelogUpdateRequest;
use App\Repositories\TimelogRepository;
use App\Validators\TimelogValidator;

/**
 * Class TimelogsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TimelogsController extends Controller
{
    /**
     * @var TimelogRepository
     */
    protected $repository;

    /**
     * @var TimelogValidator
     */
    protected $validator;

    /**
     * TimelogsController constructor.
     *
     * @param TimelogRepository $repository
     * @param TimelogValidator $validator
     */
    public function __construct(TimelogRepository $repository, TimelogValidator $validator)
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
        $timelogs = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $timelogs,
            ]);
        }

        return view('timelogs.index', compact('timelogs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TimelogCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TimelogCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $timelog = $this->repository->create($request->all());

            $response = [
                'message' => 'Timelog created.',
                'data'    => $timelog->toArray(),
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
        $timelog = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $timelog,
            ]);
        }

        return view('timelogs.show', compact('timelog'));
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
        $timelog = $this->repository->find($id);

        return view('timelogs.edit', compact('timelog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TimelogUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TimelogUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $timelog = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Timelog updated.',
                'data'    => $timelog->toArray(),
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
                'message' => 'Timelog deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Timelog deleted.');
    }
}
