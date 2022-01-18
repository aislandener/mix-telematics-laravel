<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Illuminate\Support\Facades\Http;
use Jumbojett\OpenIDConnectClient;
use Jumbojett\OpenIDConnectClientException;

abstract class TokenService
{
    private $clientName;
    private $clientID;
    private $clientSecret;
    private $idBaseUrl;
    private $restBaseUrl;
    private $dynamixUserName;
    private $dynamixUserPassword;
    private $token;

    protected $http;
    protected $organisationId;

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

        $this->http = Http::withToken($this->token->access_token)->baseUrl($this->restBaseUrl);
    }

    private function getToken()
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
}