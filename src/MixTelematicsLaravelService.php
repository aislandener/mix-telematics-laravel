<?php

namespace Aislandener\MixTelematicsLaravel;

use Http;
use Jumbojett\OpenIDConnectClient;
use Jumbojett\OpenIDConnectClientException;

class MixTelematicsLaravelService
{
    private $clientName;
    private $clientID;
    private $clientSecret;
    private $idBaseUrl;
    private $restBaseUrl;
    private $dynamixUserName;
    private $dynamixUserPassword;
    private $organisationId;

    private $token;

    const SCOPE = "offline_access MiX.Integrate";

    public function __construct()
    {
        $this->clientName = config('mixtelematics.clientName');
        $this->clientID = config('mixtelematics.clientID');
        $this->clientSecret = config('mixtelematics.clientSecret');
        $this->idBaseUrl = config('mixtelematics.IDBaseUrl');
        $this->restBaseUrl = config('mixtelematics.RestBaseUrl');
        $this->dynamixUserName = config('mixtelematics.dynamixUserName');
        $this->dynamixUserPassword = config('mixtelematics.dynamixUserPassword');
        $this->organisationId = config('mixtelematics.organisationId');

        $this->token = $this->getToken();
    }

    public function getToken()
    {
        $oidc = new OpenIDConnectClient(
            provider_url: $this->idBaseUrl,client_id: $this->clientID, client_secret: $this->clientSecret
        );

        $oidc->providerConfigParam([
            'token_endpoint' => "{$this->idBaseUrl}/connect/token"
        ]);
        $oidc->addScope([self::SCOPE]);
        $oidc->setClientName($this->clientName);
        $oidc->addAuthParam(['username' => $this->dynamixUserName, 'password' => $this->dynamixUserPassword]);

        try {
            return $oidc->requestResourceOwnerToken(true);
        } catch (OpenIDConnectClientException $e) {
            return null;
        }
    }

    public function getDriversOrganisation(){
        return Http::withToken($this->token)->get($this->restBaseUrl . "/api/drivers/organisation/{$this->organisationId}")->json();
    }
}
