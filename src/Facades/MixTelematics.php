<?php

namespace Aislandener\MixTelematicsLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getToken()
 * @method static array getDriversOrganisation()
 */
class MixTelematics extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MixTelematics';
    }
}
