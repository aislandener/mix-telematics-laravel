<?php

namespace Aislandener\MixTelematicsLaravel;

use Aislandener\MixTelematicsLaravel\Models\Driver;
use Aislandener\MixTelematicsLaravel\Services\ActiveEventsService;
use Aislandener\MixTelematicsLaravel\Services\AssetService;
use Aislandener\MixTelematicsLaravel\Services\DriversService;
use Aislandener\MixTelematicsLaravel\Services\GroupService;
use Aislandener\MixTelematicsLaravel\Services\PositionService;
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
    private GroupService $groupService;
    private PositionService $positionService;

    public function __construct(ActiveEventsService $activeEventsService,
                                DriversService      $driversService,
                                AssetService        $assetService,
                                GroupService        $groupService,
                                PositionService     $positionService,
    )
    {
        $this->driversService = $driversService;
        $this->activeEventsService = $activeEventsService;
        $this->assetService = $assetService;
        $this->groupService = $groupService;
        $this->positionService = $positionService;
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

    /**
     * @return GroupService
     */
    public function groups(): GroupService
    {
        return $this->groupService;
    }

    public function positions(): PositionService
    {
        return $this->positionService;
    }


}
