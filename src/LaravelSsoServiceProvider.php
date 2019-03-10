<?php

namespace Xigemall\LaravelSso;

use Xigemall\LaravelSso\App\Services\OaGuard;
use Xigemall\LaravelSso\App\Services\OaUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class LaravelSsoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/sso.php' => config_path('sso.php'),
        ]);

        Auth::extend('oa', function ($app, $name, array $config) {
            return new OaGuard(Auth::createUserProvider($config['provider']));
        });

        Auth::provider('oa', function ($app, array $config) {
            return new OaUserProvider();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }
}
