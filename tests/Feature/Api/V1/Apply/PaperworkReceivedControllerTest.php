<?php

namespace Tests\Feature\Api\V1\Apply;

use App\Apply\Models\Applicant;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaperworkReceivedControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_marks_an_applicant_as_having_had_their_start_paperwork_received()
    {
        $applicant = factory(Applicant::class)->create();

        $response = $this->json('PATCH', route('api.apply.applicants.paperwork-received', $applicant->id));

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($applicant->fresh()->received_at->format('Y-m-d'), Carbon::now()->format('Y-m-d'));
    }
}
