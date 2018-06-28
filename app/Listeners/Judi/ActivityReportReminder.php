<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\AssessmentMailer;
use Illuminate\Queue\SerializesModels;
use App\Events\Judi\SummaryWasSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Judi\Repositories\SummaryRepository;
use App\Judi\Repositories\AssessmentRepository;

class ActivityReportReminder implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var SummaryRepository
     */
    private $assessments;

    /**
     * @var
     */
    protected $caseload;

    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * @var SummaryRepository
     */
    private $summaries;

    /**
     * Create the event listener.
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
     * @return void
     */
    public function handle(SummaryWasSubmitted $event)
    {
        $summary = $this->summaries->requireById($event->getSummaryId(), true);
        $assessment = $summary->assessment;

        if ($this->assessmentComplete($assessment->assessor_id, $assessment->sector_id)) {
            $this->mailer->activityReportAssessorReminder($assessment);
        }
    }

    /**
     * Returns true when an assessor has completed their sector assessments.
     *
     * @param $assessorId
     * @param $sectorId
     * @return bool
     */
    private function assessmentComplete($assessorId, $sectorId)
    {
        return $this->assessments->getPaCaseload($assessorId, $sectorId)->count() == 0;
    }

}
