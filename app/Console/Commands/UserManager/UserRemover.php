<?php

namespace App\Console\Commands\UserManager;

use Illuminate\Console\Command;
use App\UserManager\Users\UserRepository;
use Illuminate\Support\Facades\DB;

class UserRemover extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'users:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes Users on VanDango from an end date on the Portal.';

    /**
     * @var UserRepository
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
        $this->leavers()->each(function ($user) {
            $match = $this->users->findByEmail($user->email);
            if ($match && $match->deleted_at === null) {
                $match->delete();
            }
        });
    }

    /**
     * @return mixed
     */
    public function leavers()
    {
        return DB::connection('portal')
                 ->table('data_users')
                 ->join('data_meta', 'data_users.id', '=', 'data_meta.user_id')
                 ->where('end_date', '<=', date('Y-m-d'))
                 ->get();
    }
}
