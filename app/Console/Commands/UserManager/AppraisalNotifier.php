<?php

namespace App\Console\Commands\UserManager;

use Illuminate\Console\Command;
use App\UserManager\Users\UserMailer;
use App\UserManager\Users\UserRepository;

class AppraisalNotifier extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'users:appraisal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies users of upcoming appraisal.';

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var UserMailer
     */
    private $mailer;

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
        $this->users->getAllUsersWithAppraisalsInMonth()->each(function ($user) {
            $this->mailer->appraisalDueNotification($user);
        });
    }
}
