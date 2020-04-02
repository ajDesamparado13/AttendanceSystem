<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Api\Employee\EmployeeController;
use App\Repo\Employee\EmployeeInterface;
use App\Repo\Employee\EmployeeRepository;
class EmployeeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->when(EmployeeController::class)
        ->needs(EmployeeInterface::class)
        ->give(EmployeeRepository::class);
    }
}
