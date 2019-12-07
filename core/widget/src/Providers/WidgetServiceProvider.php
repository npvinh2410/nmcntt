<?php


namespace Hydrogen\Widget\Providers;


use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'widget');
    }

    public function register() {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/widget.php', 'widget'
        );
    }
}