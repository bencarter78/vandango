<?php

namespace App\Services\Http;

use App\Contracts\Requests as RequestsInterface;
use GuzzleHttp\Client;

class Requests implements RequestsInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var
     */
    protected $response;

    /**
     * Requests constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param       $method
     * @param       $uri
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request($method, $uri, $options = [])
    {
        return $this->client->request($method, $uri, $options);
    }

    /**
     * @param       $uri
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get($uri, $options = [])
    {
        return $this->request('GET', $uri, $options);
    }

    /**
     * @param       $uri
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function post($uri, $options = [])
    {
        return $this->request('POST', $uri, $options);
    }
}