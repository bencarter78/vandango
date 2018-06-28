<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\SummaryMailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Judi\SummaryWasSubmitted;
use App\Judi\Repositories\GradeRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Judi\Repositories\SummaryRepository;

class InsufficientEvidenceNotification implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var SummaryRepository
     */
    private $summaries;

    /**
     * @var SummaryMailer
     */
    private $mailer;

    /**
     * @var GradeRepository
     */
    private $grades;

    /**
     * Create the event listener.
     *
     * @param SummaryRepository $summaries
     * @param SummaryMailer     $mailer
     * @param GradeRepository   $grades
     */
    public function __construct(SummaryRepository $summaries, SummaryMailer $mailer, GradeRepository $grades)
    {
        $this->summaries = $summaries;
        $this->mailer = $mailer;
        $this->grades = $grades;
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

        if ($this->isInsufficientGrade($summary)) {
            $this->mailer->sendInsufficientEvidenceNotification($summary->getLineManager(), $summary);
        }
    }

    /**
     * @param $summary
     * @return bool
     */
    private function isInsufficientGrade($summary)
    {
        return $summary->grade_id == $this->gradeId();
    }

    /**
     * @return mixed
     */
    private function gradeId()
    {
        $grade = $this->grades->findByName(config('vandango.judi.grades.insufficientEvidence.name'))->first();

        return $grade ? $grade->id : null;
    }
}
