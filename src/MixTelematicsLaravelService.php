<?php

namespace Aislandener\MixTelematicsLaravel;

use Aislandener\MixTelematicsLaravel\Models\Driver;
use Aislandener\MixTelematicsLaravel\Services\ActiveEventsService;
use Aislandener\MixTelematicsLaravel\Services\AssetService;
use Aislandener\MixTelematicsLaravel\Services\DriversService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Jumbojett\OpenIDConnectClient;
use Jumbojett\OpenIDConnectClientException;

class MixTelematicsLaravelService
{

    private ActiveEventsService $activeEventsService;
    private DriversService $driversService;
    private AssetService $assetService;

    public function __construct(ActiveEventsService $activeEventsService, DriversService $driversService, AssetService $assetService)
    {
        $this->driversService = $driversService;
        $this->activeEventsService = $activeEventsService;
        $this->assetService = $assetService;
    }

    /**
     * @return DriversService
     */
    public function drivers(): DriversService
    {
        return $this->driversService;
    }

    /**
     * @return ActiveEventsService
     */
    public function activeEvents(): ActiveEventsService
    {
        return $this->activeEventsService;
    }

    /**
     * @return AssetService
     */
    public function assets(): AssetService
    {
        return $this->assetService;
    }


}
