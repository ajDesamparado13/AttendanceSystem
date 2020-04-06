<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ExampleCreateRequest;
use App\Http\Requests\ExampleUpdateRequest;
use App\Repositories\ExampleRepository;
use App\Validators\ExampleValidator;

/**
 * Class ExamplesController.
 *
 * @package namespace App\Http\Controllers\Api;
 */
class ExamplesController extends Controller
{
    /**
     * @var ExampleRepository
     */
    protected $repository;

    /**
     * @var ExampleValidator
     */
    protected $validator;

    /**
     * ExamplesController constructor.
     *
     * @param ExampleRepository $repository
     * @param ExampleValidator $validator
     */
    public function __construct(ExampleRepository $repository, ExampleValidator $validator)
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
        $examples = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $examples,
            ]);
        }

        return view('examples.index', compact('examples'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExampleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ExampleCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $example = $this->repository->create($request->all());

            $response = [
                'message' => 'Example created.',
                'data'    => $example->toArray(),
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
        $example = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $example,
            ]);
        }

        return view('examples.show', compact('example'));
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
        $example = $this->repository->find($id);

        return view('examples.edit', compact('example'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExampleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ExampleUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $example = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Example updated.',
                'data'    => $example->toArray(),
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
                'message' => 'Example deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Example deleted.');
    }
}
