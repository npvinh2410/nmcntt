<?php

namespace Hydrogen\Support\Providers;

use Hydrogen\Support\Helper;
use Illuminate\Support\ServiceProvider;


class SupportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Helper::autoLoad(__DIR__ . '/../../Helpers');
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