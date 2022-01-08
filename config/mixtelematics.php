<?php
return [
    'clientName' =>  env('MIXTELEMETRICTS_CLIENT_NAME'),
    'clientID' => env('MIXTELEMETRICTS_CLIENT_ID'),
    'clientSecret' => env('MIXTELEMETRICTS_CLIENT_SECRECT'),
    'IDBaseUrl' => env('MIXTELEMETRICTS_ID_SERVER','https://identity.us.mixtelematics.com')."/core",
    'RestBaseUrl' => env('MIXTELEMETRICTS_REST_SERVER','https://integrate.us.mixtelematics.com'),
    'dynamixUserName' => env('MIXTELEMETRICTS_USERNAME'),
    'dynamixUserPassword' => env('MIXTELEMETRICTS_PASSWORD'),
    'organisationId' => env('MIXTELEMETRICTS_ORGANIZATION_ID'),
];
