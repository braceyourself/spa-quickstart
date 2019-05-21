<?php

namespace App\Providers;

use App\ApiCall;
use App\Console\Commands\MakeModel;
use App\FRC\Vendor;
use App\Observers\ApiCallObserver;
use App\Observers\VendorObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('command.model.make', function($command, $app){
            return new MakeModel($app['files']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ApiCall::observe(ApiCallObserver::class);
    }
}
