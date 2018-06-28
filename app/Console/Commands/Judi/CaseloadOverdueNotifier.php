<?php

namespace App\Console\Commands\Judi;

use App\Judi\Models\User;
use Illuminate\Console\Command;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\AssessmentRepository;

class CaseloadOverdueNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to PAs and relevant others that the assessment is overdue.';
    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var int
     */
    protected $paRoleId = 26;
    /**
     * @var AssessmentRepository
     */
    private $assessments;
    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * Create a new command instance.
     *
     * @param UserRepository       $users
     * @param AssessmentRepository $assessments
     * @param AssessmentMailer     $mailer
     */
    public function __construct(UserRepository $users, AssessmentRepository $assessments, AssessmentMailer $mailer)
    {
        parent::__construct();
        $this->users       = $users;
        $this->assessments = $assessments;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->users->getUsersWithRole($this->paRoleId) as $assessor) {
            $this->sendNotifications($this->overdueAssessments($assessor));
        }
    }

    /**
     * @param $assessor
     * @return mixed
     */
    public function overdueAssessments(User $assessor)
    {
        return $this->assessments->getOverDueAssessments($assessor->id);
    }

    /**
     * @param $assessments
     */
    public function sendNotifications($assessments)
    {
        foreach ($assessments as $assessment) {
            $this->mailer->sendOverdueAssessmentNotification($assessment);
        }
    }
}
