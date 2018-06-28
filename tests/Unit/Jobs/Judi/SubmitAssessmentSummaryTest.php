<?php

namespace Tests\Unit\Jobs\Judi;

use Tests\TestCase;
use Tests\Traits\Judi;
use Illuminate\Http\Request;
use App\Judi\Models\Summary;
use App\Events\Judi\SummaryWasSubmitted;
use App\Jobs\Judi\SubmitAssessmentSummary;
use App\Exceptions\SummaryIncompleteException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class SubmitAssessmentSummaryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /** @test */
    public function it_throws_an_exception_when_a_field_is_empty()
    {
        $this->expectException(SummaryIncompleteException::class);
        $this->doesntExpectEvents(SummaryWasSubmitted::class);

        $request = $this->mock(Request::class);
        $request->shouldReceive('has')->andReturn(true)
                ->shouldReceive('get')->with('criteria')->andReturn([0 => null]);

        $job = new SubmitAssessmentSummary($this->mock(Summary::class), $request);

        $job->handle();
    }

    /** @test */
    public function it_deletes_the_assessment_and_summary()
    {
        $this->expectsEvents(SummaryWasSubmitted::class);

        $request = $this->mock(Request::class);
        $request->shouldReceive('has')->andReturnNull();

        $summary = $this->summaries();

        $job = new SubmitAssessmentSummary($summary, $request);

        $job->handle();

        $this->assertEquals(date('Y-m-d'), $summary->deleted_at->format('Y-m-d'));
        $this->assertEquals(date('Y-m-d'), $summary->assessment->deleted_at->format('Y-m-d'));
    }
}
