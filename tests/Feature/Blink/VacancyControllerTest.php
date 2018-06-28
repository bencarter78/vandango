<?php

namespace Tests\Feature\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Status;
use App\Blink\Models\Vacancy;
use App\Jobs\Blink\SaveVacancy;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class VacancyControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_displays_the_form_to_create_a_new_vacancy()
    {
        $enquiry = $this->enquiries();

        $response = $this->actingAs($this->user())->get("/blink/vacancies/create?id=$enquiry->id");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Create Vacancy');
    }

    /** @test */
    public function it_saves_a_new_vacancy()
    {
        factory(Status::class)->create(['name' => config('vandango.blink.statuses.vacancy-saved')]);
        $vacancy = factory(Vacancy::class)->make();
        $response = $this->actingAs($this->user())->post('/blink/vacancies', array_merge($vacancy->toArray(), [
            'enquiry_id' => $this->enquiries()->id,
            'closes_on' => $vacancy->closes_on->format('d/m/Y'),
            'interviews_on' => $vacancy->interviews_on->format('d/m/Y'),
            'starts_on' => $vacancy->starts_on->format('d/m/Y'),
            'save' => true,
        ]));

        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_saves_an_existing_vacancy()
    {
        factory(Status::class)->states('draft', 'vacancy')->create();
        $vacancy = factory(Vacancy::class)->create();

        $response = $this->actingAs($this->user())->put("/blink/vacancies/$vacancy->id", array_merge($vacancy->toArray(), [
            'closes_on' => $vacancy->closes_on->format('d/m/Y'),
            'interviews_on' => $vacancy->interviews_on->format('d/m/Y'),
            'starts_on' => $vacancy->starts_on->format('d/m/Y'),
            'save' => true,
        ]));

        $response->assertRedirect("/blink/enquiries/{$vacancy->enquiry->id}/edit");
        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_submits_a_new_vacancy()
    {
        $this->expectsJobs(SaveVacancy::class);

        factory(Status::class)->states('pending', 'vacancy')->create();

        $vacancy = factory(Vacancy::class)->make();

        $response = $this->actingAs($this->user())->post('/blink/vacancies', array_merge($vacancy->toArray(), [
            'closes_on' => $vacancy->closes_on->format('d/m/Y'),
            'interviews_on' => $vacancy->interviews_on->format('d/m/Y'),
            'starts_on' => $vacancy->starts_on->format('d/m/Y'),
            'submit' => true,
        ]));

        $response->assertSessionHas('success');
    }

    /** @test */
    public function it_submits_an_existing_vacancy()
    {
        $this->expectsJobs(SaveVacancy::class);

        factory(Status::class)->states('pending', 'vacancy')->create();

        $vacancy = factory(Vacancy::class)->create();

        $response = $this->actingAs($this->user())->put("/blink/vacancies/$vacancy->id", array_merge($vacancy->toArray(), [
            'closes_on' => $vacancy->closes_on->format('d/m/Y'),
            'interviews_on' => $vacancy->interviews_on->format('d/m/Y'),
            'starts_on' => $vacancy->starts_on->format('d/m/Y'),
            'submit' => true,
        ]));

        $response->assertRedirect("/blink/enquiries/{$vacancy->enquiry->id}/edit");
        $response->assertSessionHas('success');
    }
}
