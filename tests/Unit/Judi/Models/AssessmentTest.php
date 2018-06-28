<?php

namespace Tests\Unit\Judi\Models;

use Tests\TestModel;
use Tests\Traits\Judi;
use App\Judi\Models\Assessment;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class AssessmentTest extends TestModel
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /** @test */
    public function it_returns_false_when_an_assessment_has_no_summary()
    {
        $assessment = new Assessment();
        $assessment->summary = null;
        $this->assertFalse($assessment->hasSummary());
    }

    /** @test */
    public function it_returns_true_when_an_assessment_has_a_summary()
    {
        $summary = $this->summaries();
        $this->assertTrue($summary->assessment->hasSummary());
    }

    /** @test */
    public function it_returns_true_when_an_assessment_has_been_submitted()
    {
        $summary = $this->summaries();
        $summary->assessment->delete();
        $this->assertTrue($summary->assessment->isSubmitted());
    }

    /** @test */
    public function it_returns_false_when_an_assessment_has_not_been_submitted()
    {
        $summary = $this->summaries();
        $this->assertFalse($summary->assessment->isSubmitted());
    }

    /** @test */
    public function it_returns_true_when_an_assessment_is_planned()
    {
        $summary = $this->summaries();
        $this->assertTrue($summary->assessment->isPlanned());
    }

    /** @test */
    public function it_returns_false_when_an_assessment_has_is_not_planned()
    {
        $summary = $this->summaries();
        $summary->assessment->delete();
        $this->assertFalse($summary->assessment->isPlanned());
    }

    /** @test */
    public function it_returns_a_formatted_string_when_the_last_desktop_review_took_place()
    {
        $assessment = $this->assessments(1, ['process_id' => 3, 'cancellation_id' => null]);
        $assessment->delete();

        $summary = $this->summaries(1, ['assessment_id' => $assessment->id]);
        $summary->delete();

        $this->assertEquals(
            "Last Grade: {$assessment->summary->grade->name} ({$assessment->assessment_date->format('d/m/Y')})",
            $assessment->lastDesktopReview($assessment->user->id)
        );
    }

    /** @test */
    public function it_returns_a_formatted_string_when_the_last_observation_review_took_place()
    {
        $assessment = $this->assessments(1, ['process_id' => 10, 'cancellation_id' => null]);
        $assessment->delete();

        $summary = $this->summaries(1, ['assessment_id' => $assessment->id]);
        $summary->delete();

        $this->assertEquals(
            "Last Grade: {$assessment->summary->grade->name} ({$assessment->assessment_date->format('d/m/Y')})",
            $assessment->lastObservationReview($assessment->user->id)
        );
    }

    /** @test */
    public function it_returns_a_formatted_string_of_the_last_grade()
    {
        $assessment = $this->assessments(1, ['cancellation_id' => null]);
        $assessment->delete();

        $summary = $this->summaries(1, ['assessment_id' => $assessment->id]);
        $summary->delete();

        $this->assertEquals(
            "{$assessment->summary->grade->name} ({$summary->assessment_date->format('d/m/Y')})",
            $assessment->lastGrade($assessment->user->id, $assessment->process_id)
        );
    }

    /** @test */
    public function it_returns_an_empty_string_when_no_last_assessment()
    {
        $assessment = $this->assessments(1, ['cancellation_id' => null]);
        $this->assertEquals('', $assessment->lastGrade($assessment->user->id, $assessment->process_id));
        $this->assertEquals('', $assessment->lastObservationReview($assessment->user->id));
        $this->assertEquals('', $assessment->lastDesktopReview($assessment->user->id));
    }
}
