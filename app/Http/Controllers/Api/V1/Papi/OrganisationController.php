<?php

namespace App\Http\Controllers\Api\V1\Papi;

use App\Contracts\HttpClient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrganisationController extends Controller
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUri = 'http://10.2.70.11/papi/public/api/v2';

    /**
     * PapiController constructor.
     *
     * @param $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->client->get($this->baseUri . '/organisations', [
            'query' => ['query' => $request->get('query')],
        ]);
    }
}
