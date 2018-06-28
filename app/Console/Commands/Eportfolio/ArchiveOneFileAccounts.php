<?php

namespace App\Console\Commands\Eportfolio;

use Onefile\Client;
use Illuminate\Console\Command;

class ArchiveOneFileAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onefile:archive {ids}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archives a list of OneFile accounts';
    /**
     * @var Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
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
        collect(explode(',', $this->argument('ids')))->each(function ($id) {
            $this->client->post("User/$id/Archive");
        });
    }
}
