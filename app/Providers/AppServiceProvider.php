<?php

namespace Guo\File\Providers;

use App;
use Config;
use Illuminate\Support\ServiceProvider;
use Lang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
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
