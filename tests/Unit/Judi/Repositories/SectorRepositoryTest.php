<?php

namespace Tests\Unit\Judi\Repositories;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Sector;
use App\Judi\Models\SectorSchedule;
use App\Judi\Repositories\SectorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class SectorRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_sectors_due_for_pa_in_a_given_month()
    {
        factory(SectorSchedule::class, 2)->create(['month' => 2]);

        $repo = new SectorRepository(new Sector(), new SectorSchedule());

        $this->assertEquals(2, $repo->getSectorsDueForPaInMonth(2)->count());
    }

    /** @test */
    public function it_creates_a_schedule_for_a_sector()
    {
        $repo = new SectorRepository(new Sector(), new SectorSchedule());

        $this->assertInstanceOf(SectorSchedule::class, $repo->saveScheduledMonth($this->sectors()->id, 3));
    }

    /** @test */
    public function it_updates_a_schedule_for_a_sector()
    {
        $sector = factory(SectorSchedule::class)->create()->sector;
        $repo = new SectorRepository(new Sector(), new SectorSchedule());

        $this->assertInstanceOf(SectorSchedule::class, $repo->saveScheduledMonth($sector->id, 3));
    }
}
