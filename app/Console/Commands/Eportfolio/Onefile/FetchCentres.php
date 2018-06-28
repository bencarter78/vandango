<?php

namespace App\Console\Commands\Eportfolio;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use App\Eportfolios\Models\Centre;

class FetchCentres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onefile:fetch-centres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Requests and saves any new Onefile centres';

    /**
     * @var Client
     */
    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client([
            'base_uri' => config('vandango.eportfolios.onefile.base-url'),
            'headers' => ['X-CustomerToken' => config('vandango.eportfolios.onefile.customer-token')],
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->authenticate()->fetchCentres()->each(function ($centre) {
            Centre::firstOrCreate(['centre_id' => $centre->ID], [
                'type' => 'onefile',
                'name' => $centre->Name,
            ]);
        });
    }

    /**
     * @return FetchCentres
     */
    private function authenticate()
    {
        $response = $this->client->request('POST', 'Authentication');
        $this->tokenId = $response->getBody()->getContents();

        return $this;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function fetchCentres()
    {
        $response = $this->client->request('POST', 'Organisation/Search', [
            'headers' => ['X-TokenID' => $this->tokenId],
            'form_params' => ['CustomerID' => config('vandango.eportfolios.onefile.customer-id')],
        ]);

        return collect(json_decode($response->getBody()->getContents()));
    }
}
