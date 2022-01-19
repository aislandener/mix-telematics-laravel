<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Asset;

class AssetService extends TokenService
{

    public function getAssetByGroupId($groupId = null, $filterType = null, $wildCard = null)
    {
        if(empty($groupId)){
            $groupId = $this->organisationId;
        }

        $params = null;

        if(!empty($filterType)){
            $params = array(
                'filterType' => $filterType,
                'wildCard' => $wildCard,
            );
        }

        return collect($this->http->get("/api/assets/group/{$groupId}", $params)->json())
            ->map(fn($el) => Asset::firstOrNew(['AssetId', $el['AssetId']],$el));
    }

}