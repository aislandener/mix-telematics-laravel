<?php

namespace Aislandener\MixTelematicsLaravel;

use Aislandener\MixTelematicsLaravel\Services\ActiveEventsService;
use Aislandener\MixTelematicsLaravel\Services\AssetService;
use Aislandener\MixTelematicsLaravel\Services\DriversService;
use Aislandener\MixTelematicsLaravel\Services\GroupService;
use Aislandener\MixTelematicsLaravel\Services\TokenService;
use Illuminate\Support\ServiceProvider;
use JetBrains\PhpStorm\Pure;

class MixTelematicsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->injectDependency();

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
    private function injectDependency(): void
    {
        $services = [
            GroupService::class,
            DriversService::class,
            AssetService::class,
            ActiveEventsService::class
        ];
        $this->app->when($services)
            ->needs('$clientName')
            ->giveConfig('mixtelematics.clientName');
        $this->app->when($services)
            ->needs('$clientID')
            ->giveConfig('mixtelematics.clientID');
        $this->app->when($services)
            ->needs('$clientSecret')
            ->giveConfig('mixtelematics.clientSecret');
        $this->app->when($services)
            ->needs('$idBaseUrl')
            ->giveConfig('mixtelematics.IDBaseUrl');
        $this->app->when($services)
            ->needs('$restBaseUrl')
            ->giveConfig('mixtelematics.RestBaseUrl');
        $this->app->when($services)
            ->needs('$dynamixUserName')
            ->giveConfig('mixtelematics.dynamixUserName');
        $this->app->when($services)
            ->needs('$dynamixUserPassword')
            ->giveConfig('mixtelematics.dynamixUserPassword');
        $this->app->when($services)
            ->needs('$organisationId')
            ->giveConfig('mixtelematics.organisationId');
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