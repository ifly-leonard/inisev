<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{

    /**
     *
     * The API version that's provided in all the JSON responses
     *
    */

    public const API_VERSION = 'v1';


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

    }
}
