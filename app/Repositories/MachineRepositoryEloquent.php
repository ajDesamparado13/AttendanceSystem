<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MachineRepository;
use App\Entities\Machine;
use App\Validators\MachineValidator;

/**
 * Class MachineRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MachineRepositoryEloquent extends BaseRepository implements MachineRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Machine::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MachineValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
