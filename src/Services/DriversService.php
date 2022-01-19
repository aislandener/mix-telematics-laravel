<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Driver;
use Illuminate\Support\Collection;

class DriversService extends TokenService
{
    /**
     * Get all drivers for an organisation
     * @return Collection<Driver>
     */
    public function getByOrganization(): Collection
    {
        return collect($this->http->get("/api/drivers/organisation/{$this->organisationId}")->json())
            ->map(fn($el)=> Driver::firstOrNew(['DriverId' => $el['DriverId']],$el));
    }
}