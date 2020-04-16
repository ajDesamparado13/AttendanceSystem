<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait Repo
{
    public function lengthAwarePaginate($collection)
    {
        if ($collection !== null) {
            $request = app()->make('request');
            $perPage = $request->perPage === '0' ? $collection->count() : $request->perPage;

            return new LengthAwarePaginator($collection->forPage($request->page, $perPage), $collection->count(), $perPage, $request->page);
        }
    }
}