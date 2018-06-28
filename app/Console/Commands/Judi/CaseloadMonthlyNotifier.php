<?php

namespace App\Console\Commands\Judi;

use Illuminate\Console\Command;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\AssessmentRepository;

class CaseloadMonthlyNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:dueInMonth';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to PAs with the assessments due this month';
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
     * @var AssessmentRepository
     */
    protected $assessmentsDue;

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
        $this->mailer      = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->getPas()) {
            foreach ($this->getPas() as $assessor) {
                $this->hasAssessments($assessor);
                if ($this->assessmentsDue) {
                    $this->sendNotification($this->assessmentsDue);
                }
                $this->assessmentsDue = [];
            }
        }
    }

    /**
     * @param $assessor
     * @return mixed
     */
    public function assessments($assessor)
    {
        return $this->assessments->getAssessorActivityInMonth($assessor->id);
    }

    /**
     * @param $assessor
     * @return mixed
     */
    public function hasAssessments($assessor)
    {
        $assessments = $this->assessments($assessor);
        if ($assessments->count() > 0) {
            return $this->assessmentsDue = $assessments;
        }
    }

    /**
     * @param $assessments
     * @return bool
     */
    public function sendNotification($assessments)
    {
        return $this->mailer->sendAssessmentsDueInMonthNotification($assessments);
    }

    /**
     * @return mixed
     */
    public function getPas()
    {
        return $this->users->getUsersWithRole($this->paRoleId);
    }
}
