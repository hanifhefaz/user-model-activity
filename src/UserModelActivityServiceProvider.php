<?php

namespace Hanifhefaz\UserModelActivity;

use Illuminate\Support\ServiceProvider;

class UserModelActivityServiceProvider extends ServiceProvider
{

    public static function basePath(string $path): string
    {
        return __DIR__.'/'.$path;
    }
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->make('Hanifhefaz\UserModelActivity\UserModelActivityController');
        $this->loadViewsFrom(__DIR__.'/views', 'UserModelActivity');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        include __DIR__.'/routes/web.php';

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/user-model-activity'),
        ], 'user-model-activity-views');

        $this->publishes([
            __DIR__.'/config/user-model-activity.php' => config_path('user-model-activity.php'),
        ], 'user-model-activity-config');

        $this->defineAssetPublishing();
    }

    protected function defineAssetPublishing()
    {
        $this->publishes([
            self::basePath('/assets') => public_path('vendor/user-model-activity'),
        ], ['user-model-activity-assets', 'laravel-assets']);
    }

}

