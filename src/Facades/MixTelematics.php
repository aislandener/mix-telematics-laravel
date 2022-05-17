<?php

namespace Aislandener\MixTelematicsLaravel\Facades;

use Aislandener\MixTelematicsLaravel\Services\ActiveEventsService;
use Aislandener\MixTelematicsLaravel\Services\AssetService;
use Aislandener\MixTelematicsLaravel\Services\DriversService;
use Aislandener\MixTelematicsLaravel\Services\GroupService;
use Aislandener\MixTelematicsLaravel\Services\PositionService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static DriversService drivers()
 * @method static ActiveEventsService activeEvents()
 * @method static AssetService assets()
 * @method static GroupService groups()
 * @method static PositionService positions()
 */
class MixTelematics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MixTelematics';
    }
}
