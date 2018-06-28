<?php

namespace App\Console\Commands\Judi;

use Illuminate\Console\Command;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\AssessmentRepository;

class SendInLearningList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'judi:sendInLearning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the relevant PA the in-training list for a Progress Review Assessments user.';

    /**
     * @var AssessmentRepository
     */
    private $assessments;

    /**
     * The ID of the Progress Review Process
     *
     * @var int
     */
    protected $progressReviewDesktopId = 3;

    /**
     * The numbers of months prior to the assessment to send the notification
     * of the in-learning list to Programme Admin.
     *
     * @var int
     */
    protected $getNotifyingPeriod = 2;

    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * Create a new command instance.
     *
     * @param AssessmentRepository $assessments
     * @param AssessmentMailer     $mailer
     */
    public function __construct(AssessmentRepository $assessments, AssessmentMailer $mailer)
    {
        parent::__construct();
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
        $this->request($this->getAssessments());
    }

    /**
     * @param $assessments
     */
    public function request($assessments)
    {
        if (count($assessments) > 0) {
            $this->mailer->sendInLearningListRequest($assessments);
        }
    }

    /**
     * @return array|mixed
     */
    public function getAssessments()
    {
        return $this->assessments->getAssessmentTypeInMonth($this->progressReviewDesktopId, $this->getNotifyingPeriod);
    }
}
