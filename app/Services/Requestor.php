<?php
namespace App\Services;

use GuzzleHttp\Client;

class Requestor
{
    /**
     * @var
     */
    protected $client;

    /**
     * @var
     */
    protected $request;

    /**
     * @var
     */
    protected $response;

    /**
     * @var
     */
    protected $stream;

    /**
     * Requestor constructor.
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
     * @return $this
     */
    public function make($url, $params)
    {
        $this->setResponse($this->client->get($url, $params));

        if ($this->response) {
            $this->setStream($this->response);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        if ($this->stream) {
            return $this->stream->getContents();
        }

        return [];
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

    /**
     * @return mixed
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * @param mixed $stream
     */
    public function setStream($stream)
    {
        $this->stream = $stream->getBody();
    }
}
