<?php

namespace Tests\Unit\Console\Commands\Judi;

use Tests\TestCase;
use App\Judi\Models\Assessment;
use App\Mail\Judi\AssessmentMailer;
use App\Console\Commands\Judi\StaffPaNotifier;
use App\Judi\Repositories\AssessmentRepository;

/**
 * @group judi
 */
class StaffPaNotifierTest extends TestCase
{
    /** @test */
    function it_gets_all_due_assessments()
    {
        $repository = $this->mock(AssessmentRepository::class);
        $repository->shouldReceive('getActivityInMonth')->andReturn([$this->mock(Assessment::class)]);

        $notifier = new StaffPaNotifier($repository, $this->mock(AssessmentMailer::class));
        $assessments = $notifier->getAssessments();

        $this->assertCount(1, $assessments);
        $this->assertInstanceOf(Assessment::class, $assessments[0]);
    }
}
