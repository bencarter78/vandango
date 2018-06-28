<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use App\Blink\Models\Vacancy;
use App\Apply\Models\Applicant;
use App\UserManager\Users\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class VacancyHireControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_records_an_identified_applicant_as_being_a_successful_vacancy_applicant()
    {
        $user = factory(User::class)->create();
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id), [
            'applicant_id' => $applicant->id,
            'user_id' => $user->id,
            'filled_by' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['ok' => true]);
        $this->assertEquals(1, $vacancy->hires->count());
    }

    /** @test */
    public function it_records_the_user_who_made_the_applicant_successful()
    {
        $user = factory(User::class)->create();
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id), [
            'applicant_id' => $applicant->id,
            'user_id' => $user->id,
            'filled_by' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($user->id, $vacancy->hires->first()->pivot->user_id);
    }

    /** @test */
    public function it_records_the_user_who_filled_the_vacancy()
    {
        $user = factory(User::class)->create();
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id), [
            'applicant_id' => $applicant->id,
            'user_id' => $user->id,
            'filled_by' => $user->id,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($user->id, $vacancy->hires->first()->pivot->filled_by);
    }

    /** @test */
    public function the_applicant_id_is_required()
    {
        $vacancy = factory(Vacancy::class)->create();

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['applicant_id']);
    }

    /** @test */
    public function the_user_id_is_required()
    {
        $vacancy = factory(Vacancy::class)->create();

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['user_id']);
    }

    /** @test */
    public function the_filled_by_is_required()
    {
        $vacancy = factory(Vacancy::class)->create();

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonFragment(['filled_by']);
    }

    /** @test */
    public function an_applicant_cant_be_added_to_a_vacancy_more_than_once()
    {
        $vacancy = factory(Vacancy::class)->create();
        $applicant = factory(Applicant::class)->create(['enquiry_id' => $vacancy->enquiry_id]);
        $vacancy->hires()->attach($applicant->id, ['user_id' => 1234, 'filled_by' => 1234]);

        $this->assertEquals(1, $vacancy->hires->count());

        $response = $this->json('post', route('api.blink.vacancies.hires.store', $vacancy->id), [
            'applicant_id' => $applicant->id,
            'user_id' => 1234,
            'filled_by' => 1234,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(1, $vacancy->fresh()->hires->count());
    }
}
