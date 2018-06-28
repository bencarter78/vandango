<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\Judi\Models\User;
use App\Judi\Models\Grade;
use App\Judi\Models\Summary;
use App\Mail\Judi\SummaryMailer;
use App\Events\Judi\SummaryWasSubmitted;
use App\Judi\Repositories\GradeRepository;
use App\Judi\Repositories\SummaryRepository;
use App\Listeners\Judi\InsufficientEvidenceNotification;

/**
 * @group judi
 */
class InsufficientEvidenceNotificationTest extends TestCase
{
    public function listen($mailer, $grade)
    {
        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId');

        $summary = $this->mock(Summary::class);
        $summary->shouldReceive('getAttribute')->with('grade_id')->andReturn(1);
        $summary->shouldReceive('getLineManager')->andReturn(new User());

        $repo = $this->mock(SummaryRepository::class);
        $repo->shouldReceive('requireById')->once()->andReturn($summary);

        $grades = $this->mock(GradeRepository::class);
        $grades->shouldReceive('findByName')->once()->andReturn(collect([$grade]));

        $notification = new InsufficientEvidenceNotification($repo, $mailer, $grades);
        $notification->handle($event);
    }

    /** @test */
    function it_sends_an_email_for_an_insufficient_evidence_graded_assessment()
    {
        $mailer = $this->mock(SummaryMailer::class);
        $mailer->shouldReceive('sendInsufficientEvidenceNotification')->once();

        $grade = $this->mock(Grade::class);
        $grade->shouldReceive('getAttribute')->once()->with('id')->andReturn(1);

        $this->listen($mailer, $grade);
    }

    /** @test */
    function it_does_not_send_an_email_for_an_sufficient_evidence_graded_assessment()
    {
        $mailer = $this->mock(SummaryMailer::class);
        $mailer->shouldNotReceive('sendInsufficientEvidenceNotification');

        $grade = $this->mock(Grade::class);
        $grade->shouldReceive('getAttribute')->once()->with('id')->andReturn(3);

        $this->listen($mailer, $grade);
    }
}
