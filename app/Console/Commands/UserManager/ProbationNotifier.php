<?php

namespace App\Console\Commands\UserManager;

use Illuminate\Console\Command;
use App\UserManager\Users\UserMailer;
use App\UserManager\Users\UserRepository;

class ProbationNotifier extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'users:probation {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies all relevant managers that a staff member\'s probation end date has been reached.';

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * @var array
     */
    private $probations = [];

    /**
     * @var
     */
    private $notification;

    /**
     * Create a new command instance.
     *
     * @param UserRepository $users
     * @param UserMailer     $mailer
     */
    public function __construct(UserRepository $users, UserMailer $mailer)
    {
        parent::__construct();
        $this->users = $users;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->getUsers();

        $this->probations->each(function ($user) {
            $user->departments->each(function ($department) use ($user) {
                $manager = $this->users->requireById($department->manager_id);
                $this->mailer->{$this->notification}($manager, $user);
            });
        });
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        if ($this->argument('type') == 'month') {
            $this->probations = $this->users->getAllUsersEndingProbationInMonth();
            $this->notification = 'userEndingProbationInMonthNotification';
        }

        if ($this->argument('type') == 'today') {
            $this->notification = 'userEndingProbationTodayNotification';
            $this->probations = $this->users->getAllUsersEndingProbationToday();
        }
    }
}
