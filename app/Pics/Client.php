<?php

namespace App\Pics;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Cookie\CookieJar;

abstract class Client
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var CookieJar
     */
    protected $cookieJar;

    /**
     * Client constructor.
     *
     * @param $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Creates the authentication fur requests.
     *
     * @return mixed
     */
    public function login()
    {
        return $this->client->request('post', config('vandango.pics.api.login'), [
            'cookies' => $this->cookieJar,
            'json' => [
                'username' => config('vandango.pics.username'),
                'password' => config('vandango.pics.password'),
            ],
        ]);
    }

    /**
     * @return CookieJar
     */
    protected function getCookies()
    {
        if ( $this->cookieJar->count() === 0) {
            $this->login();
        }

        return $this->cookieJar;
    }

    /**
     * @param $response
     * @return mixed
     */
    public function getContents($response)
    {
        return json_decode($response->getBody()->getContents());
    }

}