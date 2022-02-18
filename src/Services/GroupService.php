<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Group;
use Illuminate\Console\Command;

class GroupService extends TokenService
{
    public function saveInDatabase(Command $command = null): Group
    {
        $response =  collect($this->http->get("/api/organisationgroups/subgroups/{$this->organisationId}")->json());

        $command?->warn("Register master group");

        $master = Group::firstOrCreate([
            'GroupId' => $response['GroupId']
        ], [
            'Type' => $response['Type'],
            'Name' => $response['Name'],
        ]);
        $master->update([
            'Type' => $response['Type'],
            'Name' => $response['Name'],
        ]);

        $subGroup = collect($response['SubGroups']);
        $bar = $command?->getOutput()?->createProgressBar($subGroup->count());

        $command?->warn("Insert SubGroups");
        $bar?->start();

        $subGroup->each(function($el) use ($master, $bar){
            $child = Group::firstOrCreate([
                'GroupId' => $el['GroupId']
            ], [
                'Type' => $el['Type'],
                'Name' => $el['Name'],
            ]);
            $child->update([
                'Type' => $el['Type'],
                'Name' => $el['Name'],
            ]);
            $child->parent()->associate($master)->save();

            if(!empty($el['SubGroups'])){
                collect($el['SubGroups'])->each(function($sub) use ($child){
                    $subGroup = Group::firstOrCreate([
                        'GroupId' => $sub['GroupId']
                    ], [
                        'Type' => $sub['Type'],
                        'Name' => $sub['Name'],
                    ]);
                    $subGroup->update([
                        'Type' => $sub['Type'],
                        'Name' => $sub['Name'],
                    ]);
                    $subGroup->parent()->associate($child)->save();
                });
            }
            $bar?->advance();
        });

        $bar?->finish();
        $command?->newLine(2);
        return $master;
    }
}