<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OAuthService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;


    /**
     * @var string
     */
    private $accessTokenUrl;

    /**
     * OAuthService constructor.
     * @param string $accessTokenUrl
     * @param string $username
     * @param string $password
     */
    public function __construct(string $accessTokenUrl, string $username, string $password)
    {
        $this->client          = new Client();

        $this->accessTokenUrl  = $accessTokenUrl;
        $this->username        = $username;
        $this->password        = $password;
    }

    /**
     * Gets the access token.
     *
     * @return array
     *
     * @throws Exception
     */
    public function getAccessToken()
    {
        try {
            $request = $this->client->post($this->accessTokenUrl, [
                'body' => json_encode([
                    'apiKey' => $this->username,
                    'secret' => $this->password,
                ]),
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);

            $response = json_decode($request->getBody()->getContents());

            return $response->token->token->value;
        } catch (RequestException $exception) {
            throw $exception;
        }
    }
}
