<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use App\Blink\Models\Vacancy;
use App\Events\Blink\VacancyWasDeleted;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class VacancyControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_vacancies()
    {
        $vacancies = factory(Vacancy::class, 2)->create();

        $response = $this->actingAs($this->user())->get('/api/v1/blink/vacancies');

        $response->assertStatus(200);
        $response->assertJsonFragment(['ref' => $vacancies->first()->ref]);
    }

    /** @test */
    public function it_deletes_a_given_vacancy()
    {
        $this->expectsEvents(VacancyWasDeleted::class);

        $vacancy = factory(Vacancy::class)->create();

        $response = $this->json('DELETE', '/api/v1/blink/vacancies/' . $vacancy->id, ['user_id' => $vacancy->submitted_by]);
        $response->assertStatus(200);
        $this->assertNotNull($vacancy->fresh()->deleted_at);
    }

    /** @test */
    public function it_returns_an_error_for_unauthorised_users_deleting_a_given_vacancy()
    {
        $this->doesntExpectEvents(VacancyWasDeleted::class);

        $user = $this->user();
        $vacancy = factory(Vacancy::class)->create();
        $vacancy->enquiry->owners()->attach($user->id, ['updated_by' => $user->id]);

        $response = $this->json('DELETE', '/api/v1/blink/vacancies/' . $vacancy->id, ['user_id' => $this->user()->id]);
        $response->assertStatus(403);
    }
}
