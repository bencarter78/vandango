<?php

namespace App\Console\Commands\UserManager;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Jobs\UserManager\TransferUser;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UserTransfer extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'users:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfers Users from Portal changes to their department.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->transfers()->each(function ($user) {
            $this->dispatch(new TransferUser($user));
        });
    }

    /**
     * @return array
     */
    public function transfers()
    {
        return DB::connection('portal')
                 ->table('data_transfers')
                 ->where('transfer_date', date('Y-m-d'))
                 ->join('data_users', 'data_users.id', '=', 'data_transfers.user_id')
                 ->join('data_meta', 'data_users.id', '=', 'data_meta.user_id')
                 ->whereNull('end_date')
                 ->get();
    }
}
