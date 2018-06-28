<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Contracts\HttpClient;
use App\Http\Controllers\Controller;

class VacancyApplicationController extends Controller
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * VacancyApplicationController constructor.
     *
     * @param $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $ref
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($ref)
    {
        $this->client->request('get', config('vandango.ava.uri') . '/vacancies/VAC00' . $ref, [
            'query' => ['api_key' => bcrypt(config('vandango.ava.apiKey')),],
        ]);

        return $this->response($this->client->getContents());
    }
}
