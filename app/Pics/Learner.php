<?php

namespace App\Pics;

use App\Contracts\HttpClient;
use GuzzleHttp\Cookie\CookieJar;

class Learner extends Client
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var CookieJar
     */
    protected $cookieJar;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Organisation constructor.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
        $this->cookieJar = new CookieJar();
        $this->endpoint = config('vandango.pics.api.learners');
    }

    /**
     * @param $ident
     * @return mixed
     */
    public function find($ident)
    {
        $response = $this->client->request('GET', "$this->endpoint/$ident", [
            'cookies' => $this->getCookies(),
        ]);

        return $this->getContents($response);
    }
}