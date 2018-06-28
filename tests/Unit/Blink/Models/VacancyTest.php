<?php

namespace Tests\Unit\Blink\Models;

use Carbon\Carbon;
use Tests\TestCase;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Apply\Models\Applicant;
use App\Events\Blink\VacancyClosingDateWasChanged;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class VacancyTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_attaches_a_status_to_a_vacancy()
    {
        $status = factory(Status::class)->create();
        $vacancy = factory(Vacancy::class)->create();
        $vacancy->addStatus($status->name);

        $this->assertEquals($status->name, $vacancy->status()->name);
        $this->assertCount(1, $vacancy->statuses);
    }

    /** @test */
    public function it_updates_the_closing_date()
    {
        $this->expectsEvents(VacancyClosingDateWasChanged::class);

        $newClosingDate = Carbon::now()->addDays(7);
        $status = factory(Status::class)->states('vacancy', 'on-nas')->create();
        $vacancy = factory(Vacancy::class)->create(['closes_on' => Carbon::now()->subDay()]);
        $vacancy->addStatus($status->name);

        $vacancy->updateClosingDate($newClosingDate);

        $this->assertEquals($newClosingDate->format('Y-m-d'), $vacancy->fresh()->closes_on->format('Y-m-d'));
    }

    /** @test */
    public function it_updates_the_status_when_the_closing_date_is_updated_to_a_future_date()
    {
        $this->expectsEvents(VacancyClosingDateWasChanged::class);

        $status = factory(Status::class)->states('vacancy', 'on-nas')->create();
        $newClosingDate = Carbon::now()->addDays(7);
        $vacancy = factory(Vacancy::class)->create(['closes_on' => Carbon::now()->subDay()]);

        $vacancy->updateClosingDate($newClosingDate);

        $this->assertEquals($status->name, $vacancy->fresh()->status()->name);
    }

    /** @test */
    public function it_does_not_change_the_status_when_the_closing_date_is_updated_to_a_past_date()
    {
        $this->doesntExpectEvents(VacancyClosingDateWasChanged::class);

        factory(Status::class)->states('vacancy', 'on-nas')->create();
        $status = factory(Status::class)->states('vacancy', 'closed')->create();
        $vacancy = factory(Vacancy::class)->create(['closes_on' => Carbon::today()]);
        $vacancy->addStatus($status->name);

        $vacancy->updateClosingDate(Carbon::now()->subDay());

        $this->assertEquals($status->name, $vacancy->fresh()->status()->name);
    }

    /** @test */
    public function it_only_saves_the_closing_date_when_it_is_different()
    {
        $this->doesntExpectEvents(VacancyClosingDateWasChanged::class);
        $vacancy = factory(Vacancy::class)->create(['closes_on' => Carbon::today()]);
        $vacancy->updateClosingDate(Carbon::today());

        $this->assertEquals(Carbon::today(), $vacancy->fresh()->closes_on);
    }

    /** @test */
    public function it_attaches_a_new_hire_to_the_vacancy_from_an_id()
    {
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $this->assertEquals(0, $vacancy->hires->count());

        $vacancy->hire($applicant, $userId = 1234, $applicationManager = 123);

        $this->assertEquals(1, $vacancy->fresh()->hires->count());
    }

    /** @test */
    public function it_attaches_a_new_hire_to_the_vacancy_from_a_model()
    {
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $this->assertEquals(0, $vacancy->hires->count());

        $vacancy->hire($applicant, $userId = 1234, $applicationManager = 123);

        $this->assertEquals(1, $vacancy->fresh()->hires->count());
    }

    /** @test */
    public function it_returns_true_if_an_applicant_has_been_hired_to_the_vacancy_from_an_id()
    {
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $vacancy->hire($applicant, $userId = 1234, $applicationManager = 123);

        $this->assertTrue($vacancy->fresh()->hasHired($applicant->id));
    }

    /** @test */
    public function it_returns_true_if_an_applicant_has_been_hired_to_the_vacancy_from_a_model()
    {
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $vacancy->hire($applicant, $userId = 1234, $applicationManager = 123);

        $this->assertTrue($vacancy->fresh()->hasHired($applicant));
    }

    /** @test */
    public function it_returns_true_if_a_vacancy_has_closed()
    {
        $status = $this->create(Status::class);
        $vacancy = $this->create(Vacancy::class, 1, ['closes_on' => Carbon::yesterday()]);
        $vacancy->addStatus($status->name, $userId = 1);

        $this->assertTrue($vacancy->hasClosed());
    }
}
