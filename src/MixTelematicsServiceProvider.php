<?php

namespace Aislandener\MixTelematicsLaravel;

use Illuminate\Support\ServiceProvider;
use JetBrains\PhpStorm\Pure;

class MixTelematicsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $configPath = __DIR__ . '/../config/mixtelematics.php';
        $this->mergeConfigFrom($configPath, 'mixtelematics');

        $this->app->singleton('MixTelematics', function (){
            return resolve(MixTelematicsLaravelService::class);
        });
    }

    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->publishConfig();
            $this->loadMigrationsFrom(__DIR__. '/../database/migrations');
        }
    }

    /**
     * @return void
     */
    private function publishConfig(): void
    {
        $configPath = __DIR__ . '/../config/mixtelematics.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('mixtelematics.php');
        } else {
            $publishPath = base_path('config/mixtelematics.php');
        }

        $this->publishes([
            $configPath => $publishPath
        ], 'mix-config');
    }
}