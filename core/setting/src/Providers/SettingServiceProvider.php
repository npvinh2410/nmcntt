<?php

namespace Hydrogen\Setting\Providers;

use Illuminate\Support\ServiceProvider;


class SettingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'setting');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}