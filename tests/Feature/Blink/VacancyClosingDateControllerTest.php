<?php

namespace Tests\Feature\Blink;

use Tests\TestCase;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use Symfony\Component\HttpFoundation\Response;
use App\Events\Blink\VacancyClosingDateWasChanged;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class VacancyClosingDateControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_updates_the_vacancy_closing_date()
    {
        $this->expectsEvents(VacancyClosingDateWasChanged::class);
        $status = factory(Status::class)->states('vacancy', 'on-nas')->create();
        $vacancy = factory(Vacancy::class)->create();
        $vacancy->statuses()->attach($status->id);

        $response = $this->actingAs($this->user())->put(route('blink.vacancies.closing-date.update', $vacancy->id), [
            'closes_on' => $vacancy->closes_on->addWeek()->format('d/m/Y'),
        ]);

        $response->assertStatus(Response::HTTP_FOUND)
                 ->assertSessionHas('success');
    }

    /** @test */
    public function it_does_not_fire_an_event_when_the_date_has_not_changed()
    {
        $this->doesntExpectEvents(VacancyClosingDateWasChanged::class);
        $vacancy = factory(Vacancy::class)->create();

        $response = $this->actingAs($this->user())
                         ->put("/blink/vacancies/$vacancy->id/closing-date", ['closes_on' => $vacancy->closes_on->format('d/m/Y')]);

        $response->assertStatus(Response::HTTP_FOUND);
    }

    /** @test */
    public function it_returns_validation_errors_when_a_date_is_not_correctly_formatted()
    {
        $this->doesntExpectEvents(VacancyClosingDateWasChanged::class);

        $this->actingAs($this->user())
             ->put("/blink/vacancies/1/closing-date", ['closes_on' => '13th July 2013'])
             ->assertStatus(Response::HTTP_FOUND)
             ->assertSessionHasErrors('closes_on');
    }

    /** @test */
    public function it_updates_the_vacancy_status_when_the_closing_date_has_extended()
    {
        $this->expectsEvents(VacancyClosingDateWasChanged::class);

        $closedStatus = factory(Status::class)->states('vacancy', 'closed')->create();
        $liveStatus = factory(Status::class)->states('vacancy', 'on-nas')->create();

        $vacancy = factory(Vacancy::class)->create();
        $vacancy->statuses()->attach($closedStatus->id);

        $this->actingAs($this->user())
             ->put("/blink/vacancies/$vacancy->id/closing-date", ['closes_on' => $vacancy->closes_on->addWeek()->format('d/m/Y')])
             ->assertStatus(Response::HTTP_FOUND)
             ->assertSessionHas('success');

        $this->assertEquals($liveStatus->name, $vacancy->fresh()->statuses->last()->name);
    }
}
