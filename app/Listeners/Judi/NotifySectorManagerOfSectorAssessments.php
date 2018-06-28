<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\AssessmentMailer;
use App\Events\Judi\SectorAssessmentsWerePlanned;

class NotifySectorManagerOfSectorAssessments
{
    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * Create the event listener.
     *
     * @param AssessmentMailer $mailer
     */
    public function __construct(AssessmentMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  SectorAssessmentsWerePlanned $event
     * @return void
     */
    public function handle(SectorAssessmentsWerePlanned $event)
    {
        $event->getSectors()->each(function ($sector) {
            $this->mailer->notifySectorManager($sector->department->manager, $sector);
        });
    }
}
