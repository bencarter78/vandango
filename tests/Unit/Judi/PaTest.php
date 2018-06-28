<?php

namespace Tests\Unit\Judi;

use App\Judi\Pa;
use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\User;
use App\Judi\Models\Assessment;
use App\Exceptions\NoEligiblePaException;
use App\Judi\Repositories\AssessmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class PaTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_the_same_PA_assigned_to_like_process_assessments()
    {
        $assessment = factory(Assessment::class)->create();
        $pa = $this->pa(1, ['processes' => [$assessment->process_id]]);

        $assessments = $this->mock(AssessmentRepository::class);
        $assessments->shouldReceive('getProcessAssessmentsBySector')->andReturn(collect([$pa]));

        $job = new Pa($assessments);
        $assignedPa = $job->assign($assessment->process, $assessment->sector);

        $this->assertInstanceOf(User::class, $assignedPa);
        $this->assertEquals($pa->id, $assignedPa->id);
    }

    /** @test */
    public function it_throws_an_exception_when_no_PAs_are_available()
    {
        $this->expectException(NoEligiblePaException::class);
        $assessment = $this->assessments();
        $assessments = $this->mock(AssessmentRepository::class);
        $assessments->shouldReceive('getProcessAssessmentsBySector')->andReturn(collect());

        (new Pa($assessments))->assign($assessment->process, $assessment->sector);
    }

    /** @test */
    public function it_returns_a_PA_when_no_like_process_assessments()
    {
        $assessment = $this->assessments();
        $pa = $this->pa(1, ['processes' => [$assessment->process_id]]);

        $assessments = $this->mock(AssessmentRepository::class);
        $assessments->shouldReceive('getProcessAssessmentsBySector')->andReturn(collect());

        $job = new Pa($assessments);
        $assignedPa = $job->assign($assessment->process, $assessment->sector);

        $this->assertInstanceOf(User::class, $assignedPa);
        $this->assertEquals($pa->id, $assignedPa->id);
    }

    /** @test */
    public function it_returns_a_PA_in_the_same_department_as_a_given_department()
    {
        $department = $this->departments(1, ['id' => config('vandango.judi.departments.learningDevelopment')]);
        $sector = $this->sectors(1, ['department_id' => $department->id]);

        $assessment = $this->assessments(1, ['sector_id' => $sector->id]);

        $pa = $this->pa(1, [
            'processes' => [$assessment->process_id],
            'sectors' => [$sector->id],
        ]);

        $assessments = $this->mock(AssessmentRepository::class);
        $assessments->shouldReceive('getProcessAssessmentsBySector')->andReturn(collect());

        $job = new Pa($assessments);
        $assignedPa = $job->assign($assessment->process, $assessment->sector);

        $this->assertInstanceOf(User::class, $assignedPa);
        $this->assertEquals($pa->id, $assignedPa->id);
    }
}
