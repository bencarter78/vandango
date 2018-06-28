<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\Judi\Models\Sector;
use App\UserManager\Users\User;
use App\Mail\Judi\AssessmentMailer;
use App\UserManager\Departments\Department;
use App\Events\Judi\SectorAssessmentsWerePlanned;
use App\Listeners\Judi\NotifySectorManagerOfSectorAssessments;

/**
 * @group judi
 */
class NotifySectorManagerOfSectorAssessmentsTest extends TestCase
{
    /** @test */
    public function it_notifies_the_manager_when_a_user_has_completed_all_assessments()
    {
        $department = $this->mock(Department::class);
        $department->shouldReceive('getAttribute')->with('manager')->andReturn(new User());

        $sector = $this->mock(Sector::class);
        $sector->shouldReceive('getAttribute')->with('department')->andReturn($department);

        $event = $this->mock(SectorAssessmentsWerePlanned::class);
        $event->shouldReceive('getSectors')->once()->andReturn(collect([$sector, $sector]));

        $mailer = $this->mock(AssessmentMailer::class);
        $mailer->shouldReceive('notifySectorManager')->times(2);

        $listener = new NotifySectorManagerOfSectorAssessments($mailer);
        $listener->handle($event);
    }
}
