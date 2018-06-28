<?php
namespace App\Core;

use App\Contracts\Datastore;
use App\Services\HttpClient;
use GuzzleHttp\Exception\ServerException;

class Pics implements Datastore
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * Pics constructor.
     *
     * @param $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $response = $this->client->get($this->getUrl(), [
            'query' => ['q' => $sql],
        ]);

        if ( ! $response) {
            throw new ServerException('No response returned from the server.');
        }

        return $this->getResults($response)->data;
    }

    /**
     * The url to the datastore
     *
     * @return mixed
     */
    public function getUrl()
    {
        return env('DATASTORE_URL', null);
    }

    /**
     * @param $response
     * @return mixed
     */
    public function getResults($response)
    {
        return json_decode($response->getBody()->getContents());
    }

}