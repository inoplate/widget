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
        $this->app->singleton('\Inoplate\Widget\Widget', 'Inoplate\Widget\Widget');
        $this->app->alias('\Inoplate\Widget\Widget', 'widget');
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