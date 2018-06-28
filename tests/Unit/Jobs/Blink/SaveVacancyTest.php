<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Jobs\Blink\SaveVacancy;
use App\Jobs\Blink\SaveActivity;
use App\Blink\Repositories\Vacancies;
use App\Events\Blink\VacancyWasReceived;
use App\Events\Blink\ApplicationManagerWasAssigned;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class SaveVacancyTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_saves_a_new_vacancy()
    {
        $this->doesntExpectEvents([ApplicationManagerWasAssigned::class, VacancyWasReceived::class]);

        factory(Status::class)->create(['name' => config('vandango.blink.statuses.vacancy-saved')]);

        $data = array_merge(factory(Vacancy::class)->make()->toArray(), [
            'enquiry_id' => 1,
            'contact_id' => 1,
            'application_manager_id' => 1,
            'submitted_by' => 1,
        ]);

        $repository = $this->mock(Vacancies::class);
        $repository->shouldReceive('getNew')->andReturn(new Vacancy());

        $this->assertInstanceOf(Vacancy::class, (new SaveVacancy($data))->handle($repository));
    }

    /** @test */
    public function it_submits_a_new_vacancy()
    {
        $this->expectsJobs(SaveActivity::class);
        $this->expectsEvents([ApplicationManagerWasAssigned::class, VacancyWasReceived::class]);

        factory(Status::class)->create(['name' => config('vandango.blink.statuses.vacancy-pending')]);

        $vacancy = factory(Vacancy::class)->make();

        $data = array_merge($vacancy->toArray(), [
            'enquiry_id' => 1,
            'contact_id' => 1,
            'application_manager_id' => 1,
            'submitted_by' => 1,
            'submit' => true,
        ]);

        $repository = $this->mock(Vacancies::class);
        $repository->shouldReceive('requireById')->andReturn($vacancy);

        $this->assertInstanceOf(Vacancy::class, (new SaveVacancy($data, $vacancy))->handle($repository));
    }
}
