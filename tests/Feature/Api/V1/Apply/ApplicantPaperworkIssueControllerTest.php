<?php

namespace Tests\Feature\Api\V1\Apply;

use Tests\TestCase;
use App\Apply\Models\Applicant;
use Symfony\Component\HttpFoundation\Response;
use App\Jobs\Apply\NotifyUserPaperworkHasIssue;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group apply
 */
class ApplicantPaperworkIssueControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_dispatches_a_job_to_notify_the_user_when_an_issue_has_been_identified()
    {
        $this->expectsJobs(NotifyUserPaperworkHasIssue::class);

        $applicant = factory(Applicant::class)->create();

        $response = $this->json('POST', "api/v1/apply/applicants/$applicant->id/paperwork-issue", [
            'user_id' => $this->user()->id,
            'description' => 'An example description',
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function the_description_is_a_required_field()
    {
        $applicant = factory(Applicant::class)->create();

        $response = $this->json('POST', "api/v1/apply/applicants/$applicant->id/paperwork-issue", [
            'user_id' => $this->user()->id,
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
