<?php

namespace Aislandener\MixTelematicsLaravel;

use Illuminate\Support\ServiceProvider;

class MixTelematicsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $configPath = __DIR__ . '/../config/mixtelematics.php';
        $this->mergeConfigFrom($configPath, 'mixtelematics');

        $this->app->singleton('MixTelematics', function (){
            return new MixTelematicsLaravelService();
        });
    }

    public function boot()
    {
        if($this->app->runningInConsole()) {
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
}