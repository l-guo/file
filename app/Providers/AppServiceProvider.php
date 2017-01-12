<?php

namespace Guo\File\Providers;

use App;
use Config;
use Illuminate\Support\ServiceProvider;
use Lang;
use Guo\File\Facades\Test;
use Guo\File\Facades\TestClass;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('test',function(){
            //return new TestService();
            return new Test;
        });

        $this->app->bind('App\Contracts\TestContract',function(){
            return new TestService();
        });

    }

    /**
     * Register routes, translations, views and publishers.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require realpath(__DIR__.'/../Http/web.php');
        }
        $this->mergeConfigFrom(
            __DIR__.'/../../resources/config/fileconfig.php', 'fileconfig'
        );

        $this->loadViewsFrom(realpath(__DIR__.'/../../resources/views'), 'file');

        $this->publishes([realpath(__DIR__.'/../../resources/config') => config_path('')], 'file');
    }
}
