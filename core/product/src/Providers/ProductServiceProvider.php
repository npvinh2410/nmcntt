<?php
namespace Hydrogen\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'product');
    }


    public function register() {

    }
}