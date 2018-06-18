<?php

namespace F15DTaboola\Connection;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Connection
{
    private $taboolaBackstage = 'https://backstage.taboola.com/';

    private $taboolaBackstageApi = '1.0';

    private $taboolaBackstageBaseApiUri = 'backstage/api/';

    private $clientId = '';

    private $clientSecret = '';

    private $accountName = '';

    private $loginTime = null;

    private $userToken = null;

    private $tokenType = 'Bearer';

    private $tokenExpire = 3600;

    public function __construct()
    {
        $this->clientId = config('taboola.client_id');
        $this->clientSecret = config('taboola.client_secret');
        $this->accountName = config('taboola.client_name');

        $this->taboolaBackstageApi = config('taboola.api_version');
        $this->tokenType = config('taboola.token_type');
    }

    public function getCredentials()
    {
        return [
            'CLIENT_ID' => $this->clientId,
            'CLIENT_SECRET' => $this->clientSecret,
            'ACCOUNT_NAME' => $this->accountName
        ];
    }

    public function getToken()
    {
        $token = Cache::remember("taboolaUserToke", 60 * 60 , function () {
            return $this->auth();
        });

        return $token;
    }

    private function auth() {

        if($this->loginTime) {
            $currentTime = time();
            $timeCount = $this->loginTime - $currentTime;

            if($timeCount >= $this->tokenExpire) {

                return $this->taboolaLogin();

            } else {
                return $this->userToken;
            }
        } else {
            return $this->taboolaLogin();
        }

    }

    private function taboolaLogin()
    {
        $http = new Client([
            'base_uri' => $this->taboolaBackstage,
        ]);

        $auth = $http->post('backstage/oauth/token',['query' => [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials'
        ]]);

        $body = json_decode($auth->getBody()->getContents());

        try {

            $this->userToken = $body->access_token;
            $this->tokenType = $body->token_type;
            $this->tokenExpire = $body->expires_in;

            $this->loginTime = time();

            return $this->userToken;

        } catch (\Exception $e) {
            Log::error('[F15D Taboola] error'. $e->getMessage());
        }
    }

    /**
     * @param string $uri
     * @return Client
     * @throws \Exception
     */
    public function httpAuthFormateUri($uri = '')
    {
        $uri = $this->taboolaBackstage.
            $this->taboolaBackstageBaseApiUri.
            $this->taboolaBackstageApi .'/' . $this->accountName .'/' . $uri ;

        return $this->httpAuthClient($uri);
    }

    /**
     * @param string $uri
     * @return Client
     * @throws \Exception
     */
    public static function httpAuthFormatedUriS($uri = null)
    {
        $self = new self();

        if($uri) {
            $uri = $uri.'/';
        }

        $uri = $self->taboolaBackstage.
            $self->taboolaBackstageBaseApiUri.
            $self->taboolaBackstageApi .'/' . $self->accountName .'/' . $uri;

        return $self->httpAuthClient($uri);
    }

    /**
     * @return Client
     * @throws \Exception
     */
    private function httpAuthClient($uri = '')
    {
        $http = $this->client = new Client([
            'base_uri' => $uri,
            'headers'  => [
                'Authorization' => $this->tokenType.' ' . $this->getToken()
            ]
        ]);

        return $http;
    }
}