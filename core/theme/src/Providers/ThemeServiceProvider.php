<?php
namespace Hydrogen\Theme\Providers;

use Illuminate\Support\ServiceProvider;
use Hydrogen\Setting\Models\Setting;

class ThemeServiceProvider extends ServiceProvider
{
//    public function get_setting($key)
//    {
//        $setting = Setting::where('key', $key)->first();
//
//        if($setting != null)
//        {
//            return $setting->value;
//        }
//
//        return false;
//    }


    public function boot() {

        $this->loadRoutesFrom(__DIR__. '/../../routes/web.php');

        // include template
        $this->loadViewsFrom(__DIR__. '/../../resources/views', 'theme');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'theme');
    }

    public function register() {
        define('__THEME_DIR__', __DIR__. '/../../resources/views');

        $router = $this->app['router'];

//        if($this->get_setting('multi_lang') == 'on')
//        {
//            config([
//                'laravellocalization.supportedLocales' => [
//                    'vi'  => array( 'name' => 'Vietnamese', 'script' => 'Latn', 'native' => 'Tiếng Việt', 'regional' => 'vi_VN'),
//                    'en' => array( 'name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB' ),
//                ],
//
//                'laravellocalization.useAcceptLanguageHeader' => true,
//
//                'laravellocalization.hideDefaultLocaleInURL' => true
//            ]);
//        }
//        else
//        {
//            config([
//                'laravellocalization.supportedLocales' => [
//                    'vi'  => array( 'name' => 'Vietnamese', 'script' => 'Latn', 'native' => 'Tiếng Việt', 'regional' => 'vi_VN'),
//                ],
//
//                'laravellocalization.useAcceptLanguageHeader' => true,
//
//                'laravellocalization.hideDefaultLocaleInURL' => true
//            ]);
//        }

    }
}