<?php

namespace Aislandener\MixTelematicsLaravel\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Jumbojett\OpenIDConnectClient;
use Jumbojett\OpenIDConnectClientException;

abstract class TokenService
{
    private string $clientName;
    private string $clientID;
    private string $clientSecret;
    private string $idBaseUrl;
    private string $restBaseUrl;
    private string $dynamixUserName;
    private string $dynamixUserPassword;
    private mixed $token;

    protected PendingRequest $http;
    protected mixed $organisationId;

    const SCOPE = "offline_access MiX.Integrate";

    public function __construct(string $clientName,
                                string $clientID,
                                string $clientSecret,
                                string $idBaseUrl,
                                string $restBaseUrl,
                                string $dynamixUserName,
                                string $dynamixUserPassword,
                                mixed $organisationId)
    {
        $this->clientName = $clientName;
        $this->clientID = $clientID;
        $this->clientSecret = $clientSecret;
        $this->idBaseUrl = $idBaseUrl;
        $this->restBaseUrl = $restBaseUrl;
        $this->dynamixUserName = $dynamixUserName;
        $this->dynamixUserPassword = $dynamixUserPassword;
        $this->organisationId = $organisationId;

        $this->token = $this->getToken();

        $this->http = Http::withToken($this->token->access_token)->baseUrl($this->restBaseUrl);
    }

    private function getToken()
    {
        $oidc = new OpenIDConnectClient(
            provider_url: $this->idBaseUrl, client_id: $this->clientID, client_secret: $this->clientSecret
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