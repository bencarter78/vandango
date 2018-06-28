<?php

namespace Tests\Feature\Api\V1\Blink;

use Carbon\Carbon;
use Tests\TestCase;
use Tests\Traits\Blink;
use App\Jobs\Apply\SaveApplicant;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group blink
 */
class ApplicantControllerTest extends TestCase
{
    use Blink;

    /** @test */
    public function it_saves_a_new_applicant()
    {
        $this->expectsJobs(SaveApplicant::class);

        $response = $this->json('POST', '/api/v1/blink/applicants', [
            'enquiry_id' => 1,
            'user_id' => 1,
            'first_name' => 'Test',
            'surname' => 'McTest',
            'dob' => Carbon::now()->subYears(20)->format('d/m/Y'),
            'email' => '',
            'starting_on' => Carbon::now()->format('d/m/Y'),
            'sector_id' => 1,
            'qualification_plan_id' => 1,
            'programme_type' => 'Apprenticeship',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function it_returns_the_errors_when_validation_fails()
    {
        $this->doesntExpectJobs(SaveApplicant::class);
        $this->json('POST', '/api/v1/blink/applicants', [])->assertJsonFragment(['enquiry_id']);
    }
}
