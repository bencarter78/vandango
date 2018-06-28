<?php

namespace App\Listeners\Judi;

use App\Judi\Models\Process;
use App\Judi\Models\Assessment;
use App\Events\Judi\SummaryWasSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Judi\Repositories\SummaryRepository;

class CreateReassessment implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var SummaryRepository
     */
    private $summaries;

    /**
     * Create the event listener.
     *
     * @param SummaryRepository $summaries
     */
    public function __construct(SummaryRepository $summaries)
    {
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

        if ($this->isProgressReviewDesktop($summary)) {
            return $this->hasFailedOnContent($summary)
                ? $this->createReassessment($summary)
                : null;
        }

        return $this->hasFailed($summary) ? $this->createReassessment($summary) : null;
    }

    /**
     * Progress Review desktops can only be reassessed when it has failed on content grade
     *
     * @param $summary
     * @return bool
     */
    public function isProgressReviewDesktop($summary)
    {
        $progressReviewDesktop = Process::whereName(config('vandango.judi.processes.progressReviewDesktopName'))->first();

        if ($progressReviewDesktop) {
            return $summary->assessment->process_id == $progressReviewDesktop->id;
        }
    }

    /**
     * @param $summary
     * @return mixed
     */
    public function hasFailedOnContent($summary)
    {
        if ($summary->criteria) {
            return $summary->criteria->filter(function ($c) {
                return $c->name == config('vandango.judi.criteria.contentGradeName')
                    && in_array($c->pivot->grade_id, config('vandango.judi.grades.failed'));
            })->count() > 0;
        }
    }

    /**
     * @param $summary
     * @return mixed
     */
    public function hasFailed($summary)
    {
        return in_array($summary->grade_id, config('vandango.judi.grades.failed'));
    }

    /**
     * @param $summary
     * @return $this
     */
    public function createReassessment($summary)
    {
        return Assessment::create([
            "user_id" => $summary->assessment->user_id,
            "sector_id" => $summary->assessment->sector_id,
            "assessor_id" => $summary->assessment->assessor_id,
            "assessment_date" => $summary->assessment->assessment_date->addMonths(6),
            "process_id" => $summary->assessment->process_id,
            'is_reassessment' => true,
        ]);
    }
}
