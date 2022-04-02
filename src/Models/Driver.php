<?php

namespace Aislandener\MixTelematicsLaravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
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

    /**
     * @return BelongsToMany
     */
    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class, 'assets_drivers');
    }

    /**
     * @return BelongsTo
     */
    public function group():BelongsTo
    {
        return $this->belongsTo(Group::class,'SiteId', 'GroupId');
    }
}