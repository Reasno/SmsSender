<?php

namespace Reasno\SmsSender\Providers;

use Illuminate\Support\ServiceProvider;
use Reasno\SmsSender\Contracts\SmsSender;
use Reasno\SmsSender\Services\ZthySmsSender;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SmsSender::class, function($app){
            return new ZthySmsSender($app['config']['services.zthy']);
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SmsSender::class];
    }
}

