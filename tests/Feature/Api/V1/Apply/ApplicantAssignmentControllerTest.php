<?php

namespace Tests\Feature\Api\V1\Apply;

use Tests\TestCase;
use App\Apply\Models\Applicant;
use App\Events\Apply\ApplicantWasAssigned;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group apply
 */
class ApplicantAssignmentControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_assigns_an_adviser_to_an_applicant()
    {
        $this->expectsEvents(ApplicantWasAssigned::class);

        $applicant = factory(Applicant::class)->create();

        $response = $this->json('post', route('api.apply.applicants.assign', $applicant->id), ['adviser_id' => $this->user()->id]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['data' => true]);
    }

    /** @test */
    public function it_returns_an_error_if_no_adviser_id_is_given()
    {
        $applicant = factory(Applicant::class)->create();

        $response = $this->json('post', route('api.apply.applicants.assign', $applicant->id), ['adviser_id' => 123]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJson(['data' => ['errors' => ['status' => 422]]]);
    }
}
