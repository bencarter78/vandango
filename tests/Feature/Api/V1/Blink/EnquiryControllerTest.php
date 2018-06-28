<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Status;
use App\Jobs\Blink\SaveEnquiryDetails;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class EnquiryControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_live_enquiries()
    {
        $enquiry = $this->enquiries();

        $response = $this->actingAs($this->user())->json('GET', '/api/v1/blink/enquiries');

        $response->assertStatus(200);
        $response->assertJson(['results' => [$enquiry->toArray()]]);
    }

    /** @test */
    public function it_can_submit_a_new_enquiry()
    {
        $this->expectsJobs(SaveEnquiryDetails::class);

        $this->create(Status::class, 1, ['name' => config('vandango.blink.enquiries.pending')]);
        $user = $this->user();

        $response = $this->json('POST', '/api/v1/blink/enquiries', [
            'user_search' => $user->fullName,
            'user_id' => $user->id,
            'contact_search' => 'Test McTest',
            'contact_tel' => '01234567890',
            'contact_email' => 'test@test.com',
            'organisation_search' => 'ABC Ltd',
            'organisation_location' => 'Testville',
            'organisation_size' => '10',
            'note' => 'This is an amazing note.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['ok' => true]);
    }

    /** @test */
    public function it_returns_the_errors_when_required_fields_are_missing()
    {
        $this->doesntExpectJobs(SaveEnquiryDetails::class);

        $response = $this->json('POST', '/api/v1/blink/enquiries');

        $response->assertStatus(422);
        $response->assertJson([
            "user_search" => ["The user search field is required."],
            "user_id" => ["The user id field is required."],
            "contact_search" => ["The contact search field is required."],
            "contact_tel" => ["The contact tel field is required when contact email is not present."],
            "contact_email" => ["The contact email field is required when contact tel is not present."],
            "organisation_search" => ["The organisation search field is required."],
            "organisation_location" => ["The organisation location field is required."],
            "note" => ["The note field is required."],
        ]);
    }
}
