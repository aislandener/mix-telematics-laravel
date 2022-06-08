<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Trip;
use Illuminate\Support\Collection;

class TripService extends TokenService
{
    public function getLatestTripsInAssetList(array $assets, int $quantity = 1, string $cachedSince = null, bool $includeSubTrips = false): Collection
    {
        $query = http_build_query([
            'cachedSince' => $cachedSince,
            'includeSubTrips' => $includeSubTrips
        ]);
        $collection = collect(
            $this->http->post("/api/trips/assets/latest/$quantity?$query", $assets)->json()
        );

        return $collection->map(function ($el){
            return Trip::make($el);
        });
    }
}