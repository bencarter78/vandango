<?php

namespace Tests\Unit\Judi\Repositories;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Report;
use App\Judi\Repositories\ReportRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class ReportRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_report()
    {
        $repo = new ReportRepository(new Report());
        $this->assertInstanceOf(Report::class, $repo->create([
            'title' => 'My Report',
            'description' => 'Some description here...',
        ]));
    }

    /** @test */
    public function it_syncs_the_criteria_to_a_report()
    {
        $repo = new ReportRepository(new Report());
        $report = $repo->create([
            'title' => 'My Report',
            'description' => 'Some description here...',
            'criteria' => $this->criteria(3)->pluck('id')->all(),
        ]);
        $this->assertEquals(3, $report->criteria->count());
    }

    /** @test */
    public function it_updates_a_report()
    {
        $report = $this->reports(1);
        $repo = new ReportRepository(new Report());
        $this->assertInstanceOf(Report::class, $repo->update($report->id, [
            'title' => 'My Report',
            'description' => 'Some description here...',
        ]));
    }
}
