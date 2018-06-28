<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\Mail\Judi\AssessmentMailer;
use App\Judi\Repositories\UserRepository;
use App\Events\Judi\SectorAssessmentsWerePlanned;
use App\Listeners\Judi\NotifyJudiAdminOfSectorAssessments;

/**
 * @group judi
 */
class NotifyJudiAdminOfSectorAssessmentsTest extends TestCase
{
    /** @test */
    public function it_notifies_the_admins_when_assessments_are_generated()
    {
        $event = $this->mock(SectorAssessmentsWerePlanned::class);
        $event->shouldReceive('getSectors')->once()->andReturn(collect());

        $repo = $this->mock(UserRepository::class);
        $repo->shouldReceive('findByEmail')->andReturn(new User);

        $mailer = $this->mock(AssessmentMailer::class);
        $mailer->shouldReceive('notifyJudiAdmin')->once();

        $listener = new NotifyJudiAdminOfSectorAssessments($mailer, $repo);
        $listener->handle($event);
    }
}
