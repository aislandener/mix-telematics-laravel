<?php

namespace Aislandener\MixTelematicsLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [
        'PositionId',
        'AssetId',
        'DriverId',
        'Timestamp',
        'Latitude',
        'Longitude',
        'SpeedKilometresPerHour',
        'SpeedLimit',
        'AltitudeMetres',
        'Heading',
        'NumberOfSatellites',
        'Hdop',
        'Vdop',
        'Pdop',
        'AgeOfReadingSeconds',
        'DistanceSinceReadingKilometres',
        'OdometerKilometres',
        'FormattedAddress',
        'Source',
        'IsAvl',
    ];

    protected $casts = [
        'IsAvl' => 'boolean',
        'Timestamp' => 'timestamp'
    ];

    /**
     * @return BelongsTo
     */
    public function asset() : BelongsTo
    {
        return $this->belongsTo(Asset::class, 'AssetId', 'AssetId');
    }

    /**
     * @return BelongsTo
     */
    public function driver() : BelongsTo
    {
        return $this->belongsTo(Driver::class, 'DriverId', 'DriverId');
    }


}