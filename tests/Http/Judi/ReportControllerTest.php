<?php

namespace Tests\Http\Judi;

use Tests\Traits\Judi;
use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group judi
 */
class ReportControllerTest extends BrowserKitTest
{
    use DatabaseMigrations, Judi;

    /** @test */
    function it_displays_all_reports_to_the_judiAdmin()
    {
        $reports = $this->reports(5);

        $this->actingAs($this->groupUser(['judiAdmin', 'judi']))
             ->visit('judi/reports')
             ->see('All Reports')
             ->see($reports->first()->title)
             ->see($reports->last()->title);
    }

    /** @test */
    function it_displays_all_criteria_to_a_report()
    {
        $report = $this->reports(1);
        $criteria = $this->criteria();

        $report->criteria()->attach($criteria->pluck('id')->all());

        $this->actingAs($this->groupUser(['judiAdmin', 'judi']))
             ->visit("judi/reports/{$report->id}")
             ->see($report->title);
    }

}
