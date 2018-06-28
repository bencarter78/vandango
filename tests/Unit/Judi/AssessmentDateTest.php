<?php

namespace Tests\Unit\Judi;

use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Sector;
use App\Judi\AssessmentDate;
use App\Judi\Models\SectorSchedule;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class AssessmentDateTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_a_date_for_a_user_on_probation_for_a_given_process()
    {
        $date = Carbon::now();
        $process = $this->processes(1, ['trigger_week' => 1]);
        $user = $this->user();
        $user->meta->start_date = $date->format('Y-m-d');
        $sector = factory(Sector::class)->create();

        $job = new AssessmentDate();
        $this->assertEquals($date->addWeek()->format('Y-m-d'), $job->assign($process, $user, $sector));
    }

    /** @test */
    public function it_returns_a_date_for_an_existing_user_for_a_given_process_for_a_future_sector_scheduled_month()
    {
        $date = Carbon::now()->addMonth();
        $process = $this->processes();
        $user = $this->user();
        $user->meta->probation_end_date = null;
        $sector = factory(SectorSchedule::class)->create(['month' => $date->format('n')])->sector;

        $job = new AssessmentDate();
        $this->assertEquals($date->endOfMonth()->format('Y-m-d'), $job->assign($process, $user, $sector));
    }

    /** @test */
    public function it_returns_a_date_for_an_existing_user_for_a_given_process_for_next_year()
    {
        $date = Carbon::now()->subMonth();
        $process = $this->processes();
        $user = $this->user();
        $user->meta->probation_end_date = null;
        $sector = factory(SectorSchedule::class)->create(['month' => $date->format('n')])->sector;

        $job = new AssessmentDate();
        $this->assertEquals($date->addYear()->endOfMonth()->format('Y-m-d'), $job->assign($process, $user, $sector));
    }
}
