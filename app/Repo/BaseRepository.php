<?php

namespace App\Repo;

use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseInterface
{

    public function where($field, $value)
    {
        return $this->modelName->where($field, $value);
    }
    public function create($array)
    {
        $this->modelName->create($array);
    }

    public function paginate($collection)
    {
        if ($collection !== null) {
            $request = app()->make('request');
            $perPage = $request->perPage === '0' ? $collection->count() : $request->perPage;

            return new LengthAwarePaginator($collection->forPage($request->page, $perPage), $collection->count(), $perPage, $request->page);
        }
    }

    
}
