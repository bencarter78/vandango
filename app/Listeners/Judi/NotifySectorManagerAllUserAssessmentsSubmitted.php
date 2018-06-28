<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\AssessmentMailer;
use Illuminate\Queue\SerializesModels;
use App\Events\Judi\SummaryWasSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Judi\Repositories\SummaryRepository;
use App\Judi\Repositories\AssessmentRepository;

class NotifySectorManagerAllUserAssessmentsSubmitted implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $summary;

    /**
     * @var AssessmentRepository
     */
    private $assessments;

    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * @var SummaryRepository
     */
    private $summaries;

    /**
     * Create the event handler.
     *
     * @param AssessmentRepository $assessments
     * @param AssessmentMailer     $mailer
     * @param SummaryRepository    $summaries
     */
    public function __construct(
        AssessmentRepository $assessments,
        AssessmentMailer $mailer,
        SummaryRepository $summaries
    ) {
        $this->assessments = $assessments;
        $this->mailer = $mailer;
        $this->summaries = $summaries;
    }

    /**
     * Handle the event.
     *
     * @param  SummaryWasSubmitted $event
     * @return mixed
     */
    public function handle(SummaryWasSubmitted $event)
    {
        $summary = $this->summaries->requireById($event->getSummaryId(), true);
        $user = $summary->assessment->user;

        if ($this->hasCompletedAssessments($user)) {
            $this->mailer->userHasCompletedAssessments($summary->getLineManager(), $user);
        }
    }

    /**
     * @param $user
     * @return bool
     */
    private function hasCompletedAssessments($user)
    {
        return $this->assessments->getAssessmentsByUser($user->id)->count() == 0;
    }
}
