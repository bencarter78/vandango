<?php

namespace Tests\Traits;

use Mockery as m;
use App\Events\Judi\SummaryWasSubmitted;
use App\Events\Judi\SummaryOutcomeWasSubmitted;

trait Events
{
    public function summaryWasSubmittedEvent()
    {
        $submission = m::mock(SummaryWasSubmitted::class);
        $submission->shouldReceive('getSummary')->andReturn($this->summary());

        return $submission;
    }

    public function summaryOutcomeWasSubmittedEvent()
    {
        $submission = m::mock(SummaryOutcomeWasSubmitted::class);
        $submission->shouldReceive('getSummary')->andReturn($this->summary());

        return $submission;
    }

}