<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\Judi\Models\User;
use App\Judi\Models\Summary;
use App\Judi\Models\Assessment;
use App\Mail\Judi\AssessmentMailer;
use App\Events\Judi\SummaryWasSubmitted;
use App\Judi\Repositories\SummaryRepository;
use App\Judi\Repositories\AssessmentRepository;
use App\Listeners\Judi\NotifySectorManagerAllUserAssessmentsSubmitted;

/**
 * @group judi
 */
class NotifySectorManagerAllUserAssessmentsSubmittedTest extends TestCase
{
    /** @test */
    public function it_notifies_the_manager_when_a_user_has_completed_all_assessments()
    {
        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId')->once()->andReturn(1);

        $assessment = $this->mock(Assessment::class);
        $assessment->shouldReceive('getAttribute')->with('user')->andReturn(new User());

        $summary = $this->mock(Summary::class);
        $summary->shouldReceive('getAttribute')->with('assessment')->andReturn($assessment);
        $summary->shouldReceive('getLineManager')->andReturn(new User());

        $assessments = $this->mock(AssessmentRepository::class);
        $assessments->shouldReceive('getAssessmentsByUser')->andReturn(collect());

        $mailer = $this->mock(AssessmentMailer::class);
        $mailer->shouldReceive('userHasCompletedAssessments')->once();

        $summaries = $this->mock(SummaryRepository::class);
        $summaries->shouldReceive('requireById')->andReturn($summary);

        $listener = new NotifySectorManagerAllUserAssessmentsSubmitted($assessments, $mailer, $summaries);
        $listener->handle($event);
    }
}
