<?php

namespace Hydrogen\Menu\Providers;
use Illuminate\Support\ServiceProvider;


class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'menu');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/menu.php', 'menu'
        );
    }
}