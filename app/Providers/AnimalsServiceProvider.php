<?php

namespace App\Providers;

use App\Services\AminalsServices;
use Illuminate\Support\ServiceProvider;

class AnimalsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(AminalsServices::class, function ($app) {
            return new AminalsServices();
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
