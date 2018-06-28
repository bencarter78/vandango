<?php

namespace App\Console\Commands\Forum;

use App\Forum\User;
use App\Forum\Thread;
use App\Forum\Channel;
use App\Contracts\HttpClient;
use Illuminate\Console\Command;

class ImportSuggestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports new suggestions from Suggestion Box App';
    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
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
        $channels = Channel::all();

        $this->client->get(config('vandango.suggestion-box.url') . 'api/suggestions');

        collect($this->client->getContents())->each(function ($suggestion) use ($channels) {
            $import = $this->ask("$suggestion->name says... $suggestion->description. Import it? y/n");

            if (in_array($import, ['n', 'N', 'no', 'No', 'NO'])) {
                return;
            }

            $channel = $this->choice("The category is from {$suggestion->category->name}, what channel should it go into?", $channels->pluck('name')->all());
            $channel = $channels->where('name', $channel)->first();

            $username = $this->ask("The suggestion is from $suggestion->name, what is their username?");
            $user = User::where('username', $username)->first();

            $title = $this->ask("The suggestion says...$suggestion->description, what should the title be?");

            $confirmed = $this->confirm("You want to create a new forum thread by $user->fullName, in the $channel->name channel titled $title?");

            if ($confirmed) {
                Thread::create([
                    'channel_id' => $channel->id,
                    'user_id' => $user->id,
                    'title' => $title,
                    'body' => $suggestion->description,
                ]);
            }
        });
    }
}
