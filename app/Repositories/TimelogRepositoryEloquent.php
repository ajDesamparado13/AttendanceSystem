<?php

namespace App\Repositories;

use App\Entities\Timelog;
use App\Repositories\TimelogRepository;
use App\Validators\TimelogValidator;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TimelogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TimelogRepositoryEloquent extends BaseRepository implements TimelogRepository
{

    protected $fieldSearchable = [
        'causer_id' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Timelog::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return TimelogValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function lastAction()
    {
        return $this->where('causerable_id', Auth::User()->id)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function lengthAwarePaginate($collection)
    {
        if ($collection !== null) {
            $request = app()->make('request');
            $perPage = $request->perPage === '0' ? $collection->count() : $request->perPage;

            return new LengthAwarePaginator($collection->forPage($request->page, $perPage), $collection->count(), $perPage, $request->page);
        }
    }

    public function mapPaginate()
    {

        $timelogs = $this->with(['causerable'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($v) {
                return [
                    'action' => $v->action,
                    'employee' => $v->causerable['employeeName'],
                    'phone' => $v->causerable['employee']['phone'],
                    'created_at' => $v->created_at,
                ];
            });

        return $this->lengthAwarePaginate($timelogs);
    }

}