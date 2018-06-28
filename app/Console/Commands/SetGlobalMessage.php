<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SetGlobalMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:set-global';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets a message to display on every page.';

    /**
     * @var array
     */
    protected $levels = ['danger', 'warning', 'info', 'success'];

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
        $level = $this->getLevel();
        $msg = $this->ask('What is the message you want to set?');
        $minutes = $this->ask('How many minutes would you like to show this message for?');

        if ( ! $this->confirmMessage($msg, $minutes)) {
            return $this->handle();
        }

        Cache::put('global-message', [$level => $msg], $minutes);

        return $this->info('You have successfully set the global message');
    }

    /**
     * @return void
     */
    public function getLevel()
    {
        $level = $this->ask('What level is this warning? (Answer: ' . implode('/', $this->levels) . ')');

        if ( ! in_array($level, $this->levels)) {
            $this->line('That status level does not exist. Please try again.');

            $this->handle();
        }

        return $level;
    }

    /**
     * @param string $msg
     * @param bool   $minutes
     * @return string
     */
    private function confirmMessage($msg, $minutes)
    {
        $this->line('So the message to be set is...');
        $this->line($msg);
        $this->line("For $minutes minutes.");
        $confirm = $this->ask('Is this correct? (Answer: yes/no)');

        return $confirm;
    }
}
