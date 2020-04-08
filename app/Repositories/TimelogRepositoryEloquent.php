<?php

namespace App\Repositories;

use App\Entities\Timelog;
use App\Repositories\TimelogRepository;
use App\Validators\TimelogValidator;
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

}