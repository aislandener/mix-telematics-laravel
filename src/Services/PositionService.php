<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Position;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class PositionService extends TokenService
{
    public function getPositions($sinceToken = 'NEW', $quantity = 1, ?Command $command = null): Collection
    {
        $collection = collect($this->http->get("/api/positions/groups/createdsince/organisation/{$this->organisationId}/sincetoken/$sinceToken/quantity/$quantity")->json());

        $command?->warn("Insert and update in Database");
        $bar = $command?->getOutput()?->createProgressBar($collection->count());

        $bar?->start();

        $collection = $collection->map(function ($el) use ($bar) {
            $position = Position::where('AssetId', $el['AssetId'])->first();
            if (!empty($position)) {
                $position->fill($el);
                $position->save();
            } else {
                $position = Position::create($el);
            }
            $bar?->advance();
            return $position;
        });
        $bar?->finish();
        $command?->newLine(2);
        return $collection;
    }
}