<?php

namespace Hydrogen\Page\Providers;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    public function boot() {


        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'page');
    }

    public function register() {

    }
}