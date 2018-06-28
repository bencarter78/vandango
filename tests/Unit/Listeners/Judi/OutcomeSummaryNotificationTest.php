<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\Judi\Models\Summary;
use App\UserManager\Users\User;
use App\Mail\Judi\SummaryMailer;
use App\UserManager\Departments\Department;
use App\Events\Judi\SummaryOutcomeWasSubmitted;
use App\Listeners\Judi\OutcomeSummaryNotification;
use App\UserManager\Departments\DepartmentRepository;

/**
 * @group judi
 */
class OutcomeSummaryNotificationTest extends TestCase
{
    /** @test */
    function it_sends_an_email_if_the_outcome_matches_a_requirement()
    {
        $mailer = $this->mock(SummaryMailer::class);
        $mailer->shouldReceive('sendOutcomeNotification')->once();

        $dept = $this->mock(Department::class);
        $dept->shouldReceive('getAttribute')->with('manager')->andReturn(new User());

        $departments = $this->mock(DepartmentRepository::class);
        $departments->shouldReceive('findBy')->andReturn(collect([$dept]));

        $summary = $this->mock(Summary::class);
        $summary->shouldReceive('getAttribute')
                ->with('outcome')
                ->andReturn(config('vandango.judi.summary.outcomeTrigger'));

        $event = $this->mock(SummaryOutcomeWasSubmitted::class);
        $event->shouldReceive('getSummary')->andReturn($summary);

        $notification = new OutcomeSummaryNotification($mailer, $departments);
        $notification->handle($event);
    }

}
