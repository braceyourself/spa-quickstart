<?php

namespace App\Providers;

use App\ApiCall;
use App\Observers\ObserverApiCalls;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		ApiCall::observe(ObserverApiCalls::class);
    }
}
