<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Driver;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class DriversService extends TokenService
{
    /**
     * Get all drivers for an organisation
     * @return Collection<Driver>
     */
    public function updateDatabaseByOrganisation(Command $command = null): Collection
    {
        $collection = collect($this->http->get("/api/drivers/organisation/{$this->organisationId}")->json());

        $command?->warn("Insert and update in Database");
        $bar = $command?->getOutput()?->createProgressBar($collection->count());

        $bar?->start();
        $collection = $collection->map(function ($el) use ($bar) {
            $driver = Driver::where('DriverId', $el['DriverId'])->first();
            if (!empty($driver)) {
                $driver->fill($el);
                $driver->save();
            } else {
                $driver = Driver::create($el);
            }
            $bar?->advance();
            return $driver;
        });
        $bar?->finish();
        $command?->newLine(2);
        return $collection;
    }
}