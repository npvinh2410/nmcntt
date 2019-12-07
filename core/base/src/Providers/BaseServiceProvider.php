<?php

namespace Hydrogen\Base\Providers;


use Hydrogen\Base\Commands\InstallCommand;
use Hydrogen\Base\Http\Middleware\ForceLogout;
use Hydrogen\Media\Providers\MediaServiceProvider;
use Hydrogen\Menu\Providers\MenuServiceProvider;
use Hydrogen\Page\Providers\PageServiceProvider;
use Hydrogen\Post\Providers\PostServiceProvider;
use Hydrogen\Product\Providers\ProductServiceProvider;
use Hydrogen\Seo\Providers\SeoServiceProvider;
use Hydrogen\Setting\Providers\SettingServiceProvider;
use Hydrogen\Slider\Providers\SliderServiceProvider;
use Hydrogen\Support\Providers\SupportServiceProvider;
use Hydrogen\Theme\Providers\ThemeServiceProvider;
use Hydrogen\Widget\Providers\WidgetServiceProvider;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }

        $this->app->register(SupportServiceProvider::class);
        $this->app->register(SettingServiceProvider::class);
        $this->app->register(MediaServiceProvider::class);
        $this->app->register(MenuServiceProvider::class);
//        $this->app->register(SliderServiceProvider::class);
//        $this->app->register(WidgetServiceProvider::class);
        $this->app->register(PageServiceProvider::class);
//        $this->app->register(PostServiceProvider::class);
//        $this->app->register(ProductServiceProvider::class);
//        $this->app->register(SeoServiceProvider::class);
        $this->app->register(ThemeServiceProvider::class);

        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'dashboard');
    }

    public function register()
    {
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('auth', ForceLogout::class);
        $this->mergeConfigFrom(
            __DIR__.'/../../config/hydrogen.php', 'hydrogen'
        );
    }

}