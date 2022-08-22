<?php

namespace Kamandlou\LaravelConfig;

use Illuminate\Support\ServiceProvider;

class LaravelConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configurePublishing();
    }

    public function register()
    {

    }

    protected function configurePublishing()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'laravel-config.php' => config_path('laravel-config.php')
        ], 'laravel-config-configs');

        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . '2022_08_22_151627_create_configs_table.php' => database_path('2022_08_22_151627_create_configs_table.php')
        ], 'laravel-config-migrations');
    }
}