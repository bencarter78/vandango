<?php

namespace App\Pics;

use App\Contracts\HttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\TransferStats;

class Organisation extends Client
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
     * @var mixed
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
        $this->endpoint = config('vandango.pics.api.employers');
    }


    /**
     * @param $ident
     * @return mixed
     */
    public function find($ident)
    {
        $response = $this->client->request('get', $this->endpoint . '/' . $ident, [
            'cookies' => $this->getCookies(),
        ]);

        return $this->getContents($response);
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
     * @param $data
     * @return mixed
     */
    public function update($data)
    {
        $response = $this->client->request('put', $this->endpoint . "/{$data['Place']}", [
            'json' => $data,
            'cookies' => $this->getCookies(),
        ]);

        return $this->getContents($response);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function search($data)
    {
        $response = $this->client->request('get', $this->endpoint, [
            'query' => $data,
            'cookies' => $this->getCookies(),
        ]);
        
        return $this->getContents($response);
    }

}