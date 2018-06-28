<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\Judi\Models\User;
use App\Judi\Models\Summary;
use App\Mail\Judi\SummaryMailer;
use App\Events\Judi\SummaryWasSubmitted;
use App\Judi\Repositories\SummaryRepository;
use App\Listeners\Judi\FailedAssessmentNotification;

/**
 * @group judi
 */
class FailedAssessmentNotificationTest extends TestCase
{
    /** @test */
    function it_sends_an_email_for_a_failed_assessment()
    {
        $mailer = $this->mock(SummaryMailer::class);
        $mailer->shouldReceive('sendFailedAssessmentNotification')->once();

        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId');

        $summary = $this->mock(Summary::class);
        $summary->shouldReceive('getAttribute')->with('grade_id')->andReturn(config('vandango.judi.grades.failed')[0]);
        $summary->shouldReceive('getLineManager')->andReturn(new User());

        $repo = $this->mock(SummaryRepository::class);
        $repo->shouldReceive('requireById')->once()->andReturn($summary);

        $notification = new FailedAssessmentNotification($mailer, $repo);
        $notification->handle($event);
    }

}
