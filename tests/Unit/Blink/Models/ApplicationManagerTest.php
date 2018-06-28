<?php

namespace Tests\Unit\Blink\Models;

use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Apply\Models\Applicant;
use App\Blink\Models\ApplicationManager;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class ApplicationManagerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_live_vacancies()
    {
        $status = $this->create(Status::class);
        $applicationManager = $this->create(ApplicationManager::class);
        $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::yesterday()])->addStatus($status->name);

        $this->assertEquals(2, $applicationManager->vacanciesLive()->count());
    }

    /** @test */
    public function it_returns_all_closed_vacancies()
    {
        $status = $this->create(Status::class);
        $applicationManager = $this->create(ApplicationManager::class);
        $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::tomorrow()])->addStatus($status->name);
        $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::yesterday()])->addStatus($status->name);
        $vacancy = $this->create(Vacancy::class, 1, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::yesterday()]);
        $vacancy->addStatus($status->name);
        $vacancy->delete();

        $this->assertEquals(2, $applicationManager->vacanciesClosed()->count());
    }

    /** @test */
    public function it_returns_the_total_number_of_hires_from_closed_vacancies()
    {
        $status = $this->create(Status::class);
        $applicationManager = $this->create(ApplicationManager::class);
        $applicant = $this->create(Applicant::class);
        $vacancies = $this->create(Vacancy::class, 5, ['application_manager_id' => $applicationManager->id, 'closes_on' => Carbon::yesterday()])->each->addStatus($status->name);;

        $vacancies->first()->hire($applicant, $userId = 123, $filledBy = $applicationManager->id);
        $vacancies->last()->hire($applicant, $userId = 123, $filledBy = $applicationManager->id);

        $this->assertEquals(2, $applicationManager->totalHired());
    }

    /** @test */
    public function it_returns_the_conversion_rate_for_filling_vacancies()
    {
        $status = $this->create(Status::class);
        $applicationManager = $this->create(ApplicationManager::class);
        $applicant = $this->create(Applicant::class);
        $vacancies = $this->create(Vacancy::class, 5, [
            'application_manager_id' => $applicationManager->id,
            'closes_on' => Carbon::yesterday(),
            'positions_count' => 1,
        ])->each->addStatus($status->name);

        $vacancies->first()->hire($applicant, $userId = 123, $filledBy = $applicationManager->id);
        $vacancies->last()->hire($applicant, $userId = 123, $filledBy = $applicationManager->id);

        $this->assertEquals(40, $applicationManager->vacancyConversionRate());
    }
}
