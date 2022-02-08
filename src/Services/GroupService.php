<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Aislandener\MixTelematicsLaravel\Models\Group;

class GroupService extends TokenService
{
    public function saveInDatabase(): Group
    {
        $response =  collect($this->http->get("/api/organisationgroups/subgroups/{$this->organisationId}")->json());

        $master = Group::firstOrCreate([
            'GroupId' => $response['GroupId']
        ], [
            'Type' => $response['Type'],
            'Name' => $response['Name'],
        ]);
        $master->fill([
            'GroupId' => $response['GroupId'],
            'Type' => $response['Type'],
            'Name' => $response['Name'],
        ])->save();

        collect($response['SubGroups'])->each(function($el) use ($master){
            $child = Group::firstOrCreate([
                'GroupId' => $el['GroupId']
            ], [
                'Type' => $el['Type'],
                'Name' => $el['Name'],
            ]);
            $child->fill([
                'GroupId' => $el['GroupId'],
                'Type' => $el['Type'],
                'Name' => $el['Name'],
            ])->save();
            $child->parent()->associate($master)->save();

            if(!empty($el['SubGroups'])){
                collect($el['SubGroups'])->each(function($sub) use ($child){
                    $subGroup = Group::firstOrCreate([
                        'GroupId' => $sub['GroupId']
                    ], [
                        'Type' => $sub['Type'],
                        'Name' => $sub['Name'],
                    ]);
                    $subGroup->fill([
                        'GroupId' => $child['GroupId'],
                        'Type' => $child['Type'],
                        'Name' => $child['Name'],
                    ])->save();
                    $subGroup->parent()->associate($child)->save();
                });
            }
        });
        return $master;
    }
}