<?php

namespace Aislandener\MixTelematicsLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'TripId',
        'AssetId',
        'DriverId',
        'TripStart',
        'TripEnd',
        'Notes',
        'PulseParameterName',
        'SubTrips',
        'EngineSeconds',
        'StartPositionId',
        'StartPosition',
        'EndPositionId',
        'EndPosition',
        'FirstDepart',
        'LastHalt',
        'DrivingTime',
        'StandingTime',
        'Duration',
        'DistanceKilometers',
        'StartOdometerKilometers',
        'EndOdometerKilometers',
        'StartEngineSeconds',
        'EndEngineSeconds',
        'PulseValue',
        'FuelUsedLitres',
        'MaxSpeedKilometersPerHour',
        'MaxAccelerationKilometersPerHourPerSecond',
        'MaxDecelerationKilometersPerHourPerSecond',
        'MaxRpm',
        'Classification',
    ];

    protected $dates = [
        'TripStart',
        'TripEnd',
        'FirstDepart',
        'LastHalt',
    ];

    protected $casts = [
        'SubTrips' => 'array',
        'StartPosition' => 'json',
        'EndPosition' => 'json',
        'Classification' => 'json',
    ];

}