<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Asset;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class AssetService extends TokenService
{

    public function getAssetByGroupId($groupId = null, $filterType = null, $wildCard = null, Command $command = null): Collection
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

        $collection = collect($this->http->get("/api/assets/group/{$groupId}", $params)->json());

        $command?->warn("Insert and update in Database");
        $bar = $command?->getOutput()?->createProgressBar($collection->count());

        $bar?->start();

        $collection = $collection->map(function($el) use ($bar) {
            $asset = Asset::where('AssetId', $el['AssetId'])->first();

            if(!empty($asset)){
                $asset->fill($el);
                $asset->save();
            }else{
                $asset = Asset::create($el);
            }

            $bar->advance();
            return $asset;
        });

        $bar?->finish();

        $command->newLine(2);
        return $collection;
    }

}