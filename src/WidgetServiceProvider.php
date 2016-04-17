<?php

namespace Inoplate\Widget;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{  
    /**
     * @var boolean
     */
    protected $defer = true;

    /**
     * Register package
     * 
     * @return void
     */
    public function register()
    {
        $this->app->singleton('widget', function($app){
            return new Widget($app['cache.store']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['widget'];
    }
}