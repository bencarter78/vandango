<?php

namespace Tests\Unit\Judi\Models;

use Carbon\Carbon;
use Tests\TestModel;
use Tests\Traits\Judi;
use App\Judi\Models\Sector;
use App\Judi\Models\SectorSchedule;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class SectorTest extends TestModel
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /** @test */
    public function it_returns_false_when_no_scheduled_month_is_set()
    {
        $this->assertFalse((new Sector)->hasPaDue());
    }

    /** @test */
    public function it_returns_true_when_a_sectors_pa_is_due()
    {
        $sector = factory(SectorSchedule::class)->create([
            'month' => Carbon::now()->addMonth()->format('n'),
        ])->sector;

        $this->assertTrue($sector->hasPaDue());
    }
}
