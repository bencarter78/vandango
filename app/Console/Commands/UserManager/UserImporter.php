<?php

namespace App\Console\Commands\UserManager;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Portal\PortalUserImports;
use Illuminate\Support\Facades\DB;
use App\Jobs\UserManager\ImportUser;
use App\UserManager\Users\UserRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UserImporter extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'users:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Users from the Portal.';

    /**
     * @var UserInterface
     */
    private $users;

    /**
     * Create a new command instance.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->usersToImport()->each(function ($user) {
            $this->dispatch(new ImportUser($user));
        });
    }

    /**
     * @return array
     */
    public function usersToImport()
    {
        return DB::connection('portal')->table('data_users')
                 ->join('data_meta', 'data_users.id', '=', 'data_meta.user_id')
                 ->whereNull('end_date')
                 ->where('created_on', '>', strtotime($this->getLastImportDate()))
                 ->get();
    }

    /**
     * @return mixed
     */
    public function getLastImportDate()
    {
        $imports = PortalUserImports::get();

        if ($imports->count() > 0) {
            return $imports->last()->updated_at->toDateTimeString();
        }

        return Carbon::now()->toDateString();
    }
}
