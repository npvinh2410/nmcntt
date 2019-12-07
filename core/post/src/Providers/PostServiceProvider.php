<?php
namespace Hydrogen\Post\Providers;

use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'post');
    }


    public function register() {

    }
}