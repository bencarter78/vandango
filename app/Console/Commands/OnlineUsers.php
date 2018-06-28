<?php

namespace App\Console\Commands;

use Redis;
use App\UserManager\Users\User;
use Illuminate\Console\Command;

class OnlineUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows all users online.';

    /**
     * Create a new command instance.
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
        $users = Redis::keys('users.online.*');

        $this->info('There are ' . count($users) . ' active users within the last 10 minutes.');

        if (count($users) > 0) {
            foreach ($users as $key) {
                $this->line(User::find(str_replace('users.online.', '', $key))->present()->name);
            }
        }
    }
}
