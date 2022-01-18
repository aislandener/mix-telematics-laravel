<?php

namespace Aislandener\MixTelematicsLaravel\Models;

class Asset extends \Illuminate\Database\Eloquent\Model
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

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'assets_drivers');
    }

}