<?php

namespace App\Listeners\Judi;

use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\UserRepository;
use App\Events\Judi\SectorAssessmentsWerePlanned;

class NotifyJudiAdminOfSectorAssessments
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var AssessmentMailer
     */
    private $mailer;

    /**
     * @param AssessmentMailer $mailer
     * @param UserRepository   $users
     */
    public function __construct(AssessmentMailer $mailer, UserRepository $users)
    {
        $this->users = $users;
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
        $this->mailer->notifyJudiAdmin($this->getJudiAdmin(), $event->getSectors());
    }

    /**
     * @return mixed
     */
    private function getJudiAdmin()
    {
        return $this->users->findByEmail(config('vandango.judi.admin.email'));
    }
}
