<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TimelogRepository;
use App\Entities\Timelog;
use App\Validators\TimelogValidator;

/**
 * Class TimelogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TimelogRepositoryEloquent extends BaseRepository implements TimelogRepository
{
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
