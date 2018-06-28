<?php

namespace App\Console\Commands\Ava;

use Carbon\Carbon;
use App\Contracts\Requests;
use App\Contracts\HttpClient;
use Illuminate\Console\Command;
use App\Jobs\Ava\ExportApplication;

class FetchNewApplications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ava:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all applications within given timeframe';
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param Requests $client
     */
    public function __construct(Requests $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->applications()->each(function ($application) {
            dispatch(new ExportApplication($application));
        });
    }

    /**
     * @return mixed
     */
    private function applications()
    {
        $response = $this->client->get(config('vandango.ava.uri') . '/applications', [
            'query' => [
                'api_key' => bcrypt(config('vandango.ava.apiKey')),
                'from' => Carbon::now()->subDay()->startOfDay()->format('Y-m-d H:i:s'),
                'to' => Carbon::now()->subDay()->endOfDay()->format('Y-m-d H:i:s'),
            ],
        ]);

        return collect(json_decode($response->getBody()->getContents()));
    }
}
