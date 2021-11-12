<?php

namespace OneThirtyOne\GoogleDrive;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/google-drive.php', 'google-drive'
        );
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/google-drive.php' => config_path('google-drive.php'),
        ], 'google-drive');
    }
}
