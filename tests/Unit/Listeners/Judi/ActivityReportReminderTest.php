<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Assessment;
use App\Mail\Judi\AssessmentMailer;
use App\Events\Judi\SummaryWasSubmitted;
use App\Judi\Repositories\SummaryRepository;
use App\Listeners\Judi\ActivityReportReminder;
use App\Judi\Repositories\AssessmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class ActivityReportReminderTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    public function listen(array $caseload, $mailer)
    {
        $summary = $this->summaries();

        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId')->once()->andReturn($summary->id);

        $assessments = $this->mock(AssessmentRepository::class);
        $assessments->shouldReceive('getPaCaseload')->once()->andReturn(collect($caseload));

        $summaries = $this->mock(SummaryRepository::class);
        $summaries->shouldReceive('requireById')->once()->andReturn($summary);

        $listener = new ActivityReportReminder($assessments, $mailer, $summaries);

        $listener->handle($event);
    }

    /** @test */
    function it_does_not_send_a_notification_when_a_pa_has_outstanding_summaries_due_for_the_sector()
    {
        $mailer = $this->mock(AssessmentMailer::class);
        $mailer->shouldNotReceive('activityReportAssessorReminder');

        $this->listen([new Assessment()], $mailer);
    }

    /** @test */
    function it_sends_a_notification_when_a_pa_has_completed_assessing_the_sector()
    {
        $mailer = $this->mock(AssessmentMailer::class);
        $mailer->shouldReceive('activityReportAssessorReminder')->once();

        $this->listen([], $mailer);
    }
}
