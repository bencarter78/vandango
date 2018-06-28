<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Contracts\HttpClient as HttpClientInterface;

class HttpClient implements HttpClientInterface
{
    /**
     * @var
     */
    protected $client;

    /**
     * @var
     */
    private $response;

    /**
     * HttpClient constructor.
     *
     * @param $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $url
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($url, $params = [])
    {
        $this->setResponse($this->client->get($url, $params));

        return $this->getResponse();
    }

    /**
     * @param $url
     * @param $options
     * @param $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function post($url, $options = [], $params = [])
    {
        $this->setResponse($this->client->post($url, $options, $params));

        return $this->getResponse();
    }

    /**
     * @param       $url
     * @param array $options
     * @param array $params
     * @return mixed
     */
    public function put($url, $options = [], $params = [])
    {
        $this->setResponse($this->client->put($url, $options, $params));

        return $this->getResponse();
    }

    /**
     * @param       $url
     * @param array $options
     * @param array $params
     * @return mixed
     */
    public function patch($url, $options = [], $params = [])
    {
        $this->setResponse($this->client->patch($url, $options, $params));

        return $this->getResponse();
    }

    /**
     * @param       $method
     * @param       $url
     * @param array $options
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request($method, $url, $options = [], $params = [])
    {
        $this->setResponse($this->client->request($method, $url, $options, $params));

        return $this->getResponse();
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        if ($this->getResponse()) {
            return json_decode($this->response->getBody()->getContents());
        }
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}