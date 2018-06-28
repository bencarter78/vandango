<?php

namespace Tests\Unit\Judi\Presenters;

use Carbon\Carbon;
use Tests\TestCase;
use App\Judi\Models\Assessment;

/**
 * @group judi
 */
class AssessmentPresenterTest extends TestCase
{
    /** @test */
    public function it_displays_how_timely_a_late_assessment_was()
    {
        $assessment = new Assessment();
        $assessment->assessment_date = Carbon::yesterday();
        $assessment->deleted_at = Carbon::now();
        $this->assertEquals(
            "<small class='text-error'>(+1)</small>",
            $assessment->present()->timeliness
        );
    }

    /** @test */
    public function it_displays_how_timely_an_early_assessment_was()
    {
        $assessment = new Assessment();
        $assessment->assessment_date = Carbon::now()->addHours(25);
        $assessment->deleted_at = Carbon::now();
        $this->assertEquals(
            "<small class='text-success'>(-1)</small>",
            $assessment->present()->timeliness
        );
    }

    /** @test */
    public function it_displays_an_empty_string_when_assessment_not_completed()
    {
        $assessment = new Assessment();
        $this->assertEquals('', $assessment->present()->timeliness);
    }
}
