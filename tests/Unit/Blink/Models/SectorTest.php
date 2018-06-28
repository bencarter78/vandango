<?php

namespace Tests\Unit\Blink\Models;

use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\Sector;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Apply\Models\Applicant;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class SectorTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_the_total_number_of_hires_from_closed_vacancies()
    {
        $status = $this->create(Status::class);
        $sector = $this->create(Sector::class);
        $applicant = $this->create(Applicant::class);
        $vacancies = $this->create(Vacancy::class, 5, ['sector_id' => $sector->id, 'closes_on' => Carbon::yesterday()])->each->addStatus($status->name);;

        $vacancies->first()->hire($applicant, $userId = 123, $filledBy = 123);
        $vacancies->last()->hire($applicant, $userId = 123, $filledBy = 123);

        $this->assertEquals(2, $sector->totalHired());
    }

    /** @test */
    public function it_returns_the_conversion_rate_for_filling_vacancies()
    {
        $status = $this->create(Status::class);
        $sector = $this->create(Sector::class);
        $applicant = $this->create(Applicant::class);
        $vacancies = $this->create(Vacancy::class, 5, [
            'sector_id' => $sector->id,
            'closes_on' => Carbon::yesterday(),
            'positions_count' => 1,
        ])->each->addStatus($status->name);

        $vacancies->first()->hire($applicant, $userId = 123, $filledBy = 123);
        $vacancies->last()->hire($applicant, $userId = 123, $filledBy = 123);

        $this->assertEquals(40, $sector->vacancyConversionRate());
    }

    /** @test */
    public function it_returns_a_sectors_live_vacancies()
    {
        $status = $this->create(Status::class);
        $sector = $this->create(Sector::class);
        $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::yesterday()])->addStatus($status->name);

        $this->assertEquals(2, $sector->vacanciesLive()->count());
    }

    /** @test */
    public function it_returns_a_sectors_closed_vacancies()
    {
        $status = $this->create(Status::class);
        $sector = $this->create(Sector::class);
        $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::yesterday()])->addStatus($status->name);
        $vacancy = $this->create(Vacancy::class, 1, ['sector_id' => $sector->id, 'closes_on' => Carbon::yesterday()]);
        $vacancy->addStatus($status->name);
        $vacancy->delete();

        $this->assertEquals(2, $sector->vacanciesClosed()->count());
    }
}
