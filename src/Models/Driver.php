<?php

namespace Aislandener\MixTelematicsLaravel\Models;

use Laravel\Sanctum\HasApiTokens;

class Driver extends \Illuminate\Database\Eloquent\Model
{
    use HasApiTokens;

    protected $table = 'drivers';

    protected $fillable = [
        'DriverId',
        'Name',
        'IsSystemDriver',
        'FmDriverId',
        'SiteId',
        'AdditionalDetailFields',
        'ExtendedDriverIdType',
        'Country',
        'EmployeeNumber',
    ];

    protected $casts =[
        'AdditionalDetailFields' => 'json',
        'IsSystemDriver' => 'boolean',
        'EmployeeNumber' => 'string'
    ];

    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'assets_drivers');
    }
}