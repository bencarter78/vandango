<?php

namespace App\Pics;

use App\Contracts\HttpClient;
use GuzzleHttp\Cookie\CookieJar;

class Applicant extends Client
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
        $this->endpoint = config('vandango.pics.api.applicants');
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->client->request('post', $this->endpoint, [
            'json' => $data,
            'cookies' => $this->getCookies(),
        ]);

        return $this->getContents($response);
    }

    /**
     * @param $ident
     * @return mixed
     */
    public function delete($ident)
    {
        $response = $this->client->request('delete', $this->endpoint . "/$ident", ['cookies' => $this->getCookies()]);

        return $this->getContents($response);
    }

}