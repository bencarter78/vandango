<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\MessageWasBroadcast;

class Broadcaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'broadcast {msg} {--channel=general} {--alert=warning}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Broadcasts a message to all logged in users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(
            new MessageWasBroadcast(
                $this->argument('msg'),
                $this->option('channel'),
                $this->option('alert')
            )
        );
    }

}
