<?php

namespace App\Console\Commands\Testing;

use Carbon\Carbon;
use App\UserManager\Users\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UserPasswordReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:password-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets all user\'s passwords for testing purposes';

    /**
     * @var string
     */
    protected $password = 'w00ds1de78';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::select(DB::raw('UPDATE users set password = "' . bcrypt($this->password) . '"'));

        return $this->info('All users passwords reset for testing.');
    }

}
