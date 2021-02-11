<?php

namespace ChrisWare\NovaBreadcrumbs;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaBreadcrumbs extends Tool
{
    const CONFIG_PATH = __DIR__ . '/../config/nova-breadcrumbs.php';

    protected $loadStyles = true;

    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-breadcrumbs', __DIR__ . '/../dist/js/tool.js');
        if ($this->loadStyles) {
            Nova::style('nova-breadcrumbs', __DIR__ . '/../dist/css/tool.css');
        }

        $this->publishes([
            self::CONFIG_PATH => config_path('nova-breadcrumbs.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'nova-breadcrumbs'
        );
    }

    /**
     * Build the view that renders the navigation links for the tool.
     */
    public function renderNavigation()
    {
        return false;
    }

    public function withoutStyles()
    {
        $this->loadStyles = false;

        return $this;
    }
}
