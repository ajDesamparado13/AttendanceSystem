<?php

namespace App\Providers;

use App\Http\Controllers\Api\Role\RoleController;
use App\Repo\Role\RoleInterface;
use App\Repo\Role\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
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
        $this->app->when(RoleController::class)
            ->needs(RoleInterface::class)
            ->give(RoleRepository::class);
    }
}
