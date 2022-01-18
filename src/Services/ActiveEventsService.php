<?php

namespace Aislandener\MixTelematicsLaravel\Services;

class ActiveEventsService extends TokenService
{
    public function getLastOrganisationActivesCreated($sinceToken = 'now', $quantity = 1000)
    {
        return $this->http->get("/api/activeevents/groups/createdsince/organisation/{$this->organisationId}/sincetoken/{$sinceToken}/quantity/{$quantity}")
            ->json();
    }

    public function postLatestActiveOrganisation($groupId = null, $quantity = 1, $eventTypeIds = [])
    {
        if(empty($groupId)){
            $groupId = $this->organisationId;
        }
        return $this->http->post("/api/activeevents/group/{$groupId}/latest/{$quantity}",[
            'eventTypeIds' => $eventTypeIds
        ])->json();
    }
}