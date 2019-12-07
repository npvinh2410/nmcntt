<?php
namespace Hydrogen\Media\Providers;

use Hydrogen\Base\Models\User\User;
use Hydrogen\Media\Repositories\Contracts\UserInterface;
use Hydrogen\Media\Repositories\Eloquent\UserRepository;
use Hydrogen\Media\Facades\HMediaFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Hydrogen\Media\Repositories\Eloquent\MediaSettingRepository;
use Hydrogen\Media\Repositories\Eloquent\MediaShareRepository;
use Hydrogen\Media\Repositories\Eloquent\MediaFileRepository;
use Hydrogen\Media\Repositories\Eloquent\MediaFolderRepository;
use Hydrogen\Media\Repositories\Contracts\MediaSettingInterface;
use Hydrogen\Media\Repositories\Contracts\MediaShareInterface;
use Hydrogen\Media\Repositories\Contracts\MediaFileInterface;
use Hydrogen\Media\Repositories\Contracts\MediaFolderInterface;
use Hydrogen\Media\Models\MediaFile;
use Hydrogen\Media\Models\MediaFolder;
use Hydrogen\Media\Models\MediaShare;
use Hydrogen\Media\Models\MediaSetting;

class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MediaFileInterface::class, function () {
            return new MediaFileRepository(new MediaFile());
        });

        $this->app->singleton(MediaFolderInterface::class, function () {
            return new MediaFolderRepository(new MediaFolder());
        });

        $this->app->singleton(MediaShareInterface::class, function () {
            return new MediaShareRepository(new MediaShare());

        });

        $this->app->singleton(MediaSettingInterface::class, function () {
            return new MediaSettingRepository(new MediaSetting());
        });

        $this->app->singleton(UserInterface::class, function () {
            return new UserRepository(new User());
        });

        AliasLoader::getInstance()->alias('HMedia', HMediaFacade::class);
        AliasLoader::getInstance()->alias('HMediaFacade', HMediaFacade::class);
    }

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/media.php', 'media');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'media');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'media');
    }
}
