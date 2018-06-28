<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\SummaryMailer;
use App\Events\Judi\SummaryOutcomeWasSubmitted;
use App\UserManager\Departments\DepartmentRepository;

class OutcomeSummaryNotification
{
    /**
     * @var SummaryMailer
     */
    private $mailer;

    /**
     * @var
     */
    protected $summary;

    /**
     * @var DepartmentRepository
     */
    private $departments;

    /**
     * Create the event listener.
     *
     * @param SummaryMailer        $mailer
     * @param DepartmentRepository $departments
     */
    public function __construct(SummaryMailer $mailer, DepartmentRepository $departments)
    {
        $this->mailer = $mailer;
        $this->departments = $departments;
    }

    /**
     * Handle the event.
     *
     * @param  SummaryOutcomeWasSubmitted $event
     */
    public function handle(SummaryOutcomeWasSubmitted $event)
    {
        $summary = $event->getSummary();

        if ($summary->outcome == config('vandango.judi.summary.outcomeTrigger')) {
            $this->mailer->sendOutcomeNotification($this->trainingManager(), $summary);
        }
    }

    /**
     * @return mixed
     */
    private function trainingManager()
    {
        return $this->departments->findBy('name', config('vandango.judi.admin.team.name'))
                                 ->first()->manager;
    }

}
