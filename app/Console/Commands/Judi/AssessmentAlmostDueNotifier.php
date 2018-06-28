<?php

namespace App\Console\Commands\Judi;

use Illuminate\Console\Command;
use App\Judi\Models\Assessment;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\UserRepository;
use App\Judi\Repositories\AssessmentRepository;

class AssessmentAlmostDueNotifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:almostDue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to PAs and relevant others that the assessment is almost due.';
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
     * @var int
     */
    protected $days = 14;

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
        foreach ($this->assessments() as $assessment) {
            $this->sendNotification($assessment);
        }
    }

    /**
     * @return mixed
     */
    public function assessments()
    {
        return $this->assessments->getAssessments($this->days);
    }

    /**
     * @param Assessment $assessment
     */
    public function sendNotification(Assessment $assessment)
    {
        $this->mailer->sendAssessmentAlmostDueNotification($assessment);
    }
}
