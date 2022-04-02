<?php

namespace Aislandener\MixTelematicsLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'AssetId',
        'CreatedDate',
        'IsConnectedTrailer',
        'AssetTypeId',
        'SiteId',
        'IsDefaultImage',
        'EngineHours',
        'Odometer',
        'FmVehicleId',
        'DefaultDriverId',
        'TargetFuelConsumption',
        'Country',
        'CreatedBy',
        'UserState',
        'AssetImageUrl',
        'AssetImage',
        'IconColour',
        'Icon',
        'Notes',
        'AdditionalMobileDevice',
        'EngineNumber',
        'VinNumber',
        'Year',
        'Model',
        'Make',
        'FleetNumber',
        'TargetHourlyFuelConsumptionUnits',
        'TargetFuelConsumptionUnits',
        'FuelType',
        'RegistrationNumber',
        'Description',
    ];

    protected $casts = [
        'IsConnectedTrailer' => 'boolean',
        'IsDefaultImage' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class, 'assets_drivers');
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class,'SiteId','GroupId');
    }

}