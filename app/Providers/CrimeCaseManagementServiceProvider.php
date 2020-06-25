<?php

namespace App\Providers;

use App\Http\Services\CrimeCases\CrimeCaseManagementService;
use Illuminate\Support\ServiceProvider;

class CrimeCaseManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Http\Services\CrimeCaseManagementService', function(){
            return new CrimeCaseManagementService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
