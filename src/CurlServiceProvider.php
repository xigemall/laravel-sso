<?php

namespace Xigemall\LaravelSso;

use Illuminate\Support\ServiceProvider;
use Xigemall\LaravelSso\Services\Curl;

class CurlServiceProvider extends ServiceProvider
{
    /**
     * 是否延时加载提供器。
     * @var bool
     */
    protected $defer = true;
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

    /**
     *  获取提供器提供的服务。
     * @return array
     */
    public function provides()
    {
       return ['curl'];
    }
}
