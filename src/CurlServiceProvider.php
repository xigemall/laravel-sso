<?php

namespace Xigemall\LaravelSso;

use Illuminate\Support\ServiceProvider;
use Xigemall\LaravelSso\App\Services\Curl;

class CurlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('curl',Curl::class);
    }
}
