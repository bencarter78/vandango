<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\SummaryMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Judi\SummaryWasSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Judi\Repositories\SummaryRepository;

class FailedAssessmentNotification implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var SummaryMailer
     */
    private $mailer;

    /**
     * @var
     */
    protected $summary;

    /**
     * @var array
     */
    protected $failedGrades = [3, 4];

    /**
     * @var
     */
    protected $manager;

    /**
     * @var SummaryRepository
     */
    private $summaries;

    /**
     * Create the event listener.
     *
     * @param SummaryMailer     $mailer
     * @param SummaryRepository $summaries
     */
    public function __construct(SummaryMailer $mailer, SummaryRepository $summaries)
    {
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

        if ($this->isFailedAssessment($summary)) {
            $this->mailer->sendFailedAssessmentNotification($summary->getLineManager(), $summary);
        }
    }

    /**
     * @param $summary
     * @return bool
     */
    private function isFailedAssessment($summary)
    {
        return in_array($summary->grade_id, config('vandango.judi.grades.failed'));
    }
}
