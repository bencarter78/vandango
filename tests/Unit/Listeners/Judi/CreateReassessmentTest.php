<?php

namespace Tests\Unit\Listeners\Judi;

use Tests\TestCase;
use App\Judi\Models\Process;
use App\Judi\Models\Summary;
use App\Judi\Models\Criteria;
use App\Judi\Models\Assessment;
use App\Events\Judi\SummaryWasSubmitted;
use App\Listeners\Judi\CreateReassessment;
use App\Judi\Repositories\SummaryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class CreateReassessmentTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    function it_determines_if_an_assessment_has_been_failed()
    {
        $summary = factory(Summary::class)->create(['grade_id' => 4]);
        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId')->andReturn($summary->id);
        $repo = $this->mock(SummaryRepository::class);
        $repo->shouldReceive('requireById')->andReturn($summary);
        $listener = new CreateReassessment($repo);

        $this->assertTrue($listener->hasFailed($summary));
    }

    /** @test */
    function it_creates_a_reassessment_when_assessment_is_failed()
    {
        $user = $this->user();
        $assessment = factory(Assessment::class)->create([
            'user_id' => $user->id,
            'assessment_date' => '2016-01-01',
        ]);
        $summary = factory(Summary::class)->create([
            'grade_id' => config('vandango.judi.grades.failed')[0],
            'assessment_id' => $assessment->id,
        ]);

        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId')->andReturn($summary->id);
        $repo = $this->mock(SummaryRepository::class);
        $repo->shouldReceive('requireById')->andReturn($summary);
        $listener = new CreateReassessment($repo);

        $reassessment = $listener->handle($event);

        $this->assertEquals('2016-07-01', $reassessment->assessment_date->format('Y-m-d'));
        $this->assertEquals(2, $assessment->user->assessments->count());
    }

    /** @test */
    function it_only_creates_a_reassessment_for_progress_review_desktop_when_content_grade_has_failed()
    {
        $process = factory(Process::class)->create(['name' => config('vandango.judi.processes.progressReviewDesktopName')]);
        $criteria = factory(Criteria::class)->create(['name' => config('vandango.judi.criteria.contentGradeName')]);
        $user = $this->user();

        $assessment = factory(Assessment::class)->create([
            'user_id' => $user->id,
            'process_id' => $process->id,
            'assessment_date' => '2016-01-01',
        ]);

        $summary = factory(Summary::class)->create([
            'grade_id' => config('vandango.judi.grades.failed')[0],
            'assessment_id' => $assessment->id,
        ]);

        $summary->criteria()->attach($criteria->id, [
            'grade_id' => config('vandango.judi.grades.failed')[0],
        ]);

        $event = $this->mock(SummaryWasSubmitted::class);
        $event->shouldReceive('getSummaryId')->andReturn($summary->id);

        $repo = $this->mock(SummaryRepository::class);
        $repo->shouldReceive('requireById')->andReturn($summary);

        $listener = new CreateReassessment($repo);

        $reassessment = $listener->handle($event);

        $this->assertEquals('2016-07-01', $reassessment->assessment_date->format('Y-m-d'));
        $this->assertEquals(2, $assessment->user->assessments->count());
    }
}
