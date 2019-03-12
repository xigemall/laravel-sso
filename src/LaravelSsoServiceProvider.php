<?php

namespace Xigemall\LaravelSso;

use Xigemall\LaravelSso\Services\OaGuard;
use Xigemall\LaravelSso\Services\OaUserProvider;
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
            __DIR__ . '/../config/sso.php' => config_path('sso.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Auth::extend('sso', function ($app, $name, array $config) {
            // 返回一个 Illuminate\Contracts\Auth\Guard 实例...
            return new OaGuard(Auth::createUserProvider($config['provider']),$app->make('request'));
        });

        Auth::provider('sso', function ($app, array $config) {
            return new OaUserProvider();
        });
    }
}
