<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use App\Blink\Models\Enquiry;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class EnquiryContactControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_company_contact_for_the_enquiry()
    {
        $enquiry = factory(Enquiry::class)->create();

        $response = $this->json('PUT', route('api.blink.enquiries.contacts.update', $enquiry->id), [
            'organisation_id' => $enquiry->contact->organisation_id,
            'name' => 'Test McTest',
            'tel' => '01234567890',
            'email' => 'test@email.com',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Test McTest', $enquiry->fresh()->contact->name);
        $this->assertEquals(2, $enquiry->fresh()->contact->organisation->contacts->count());
    }

    /** @test */
    public function it_updates_a_company_contact_for_the_enquiry()
    {
        $enquiry = factory(Enquiry::class)->create();

        $response = $this->json('PUT', route('api.blink.enquiries.contacts.update', $enquiry->id), [
            'id' => $enquiry->contact_id,
            'organisation_id' => $enquiry->contact->organisation_id,
            'name' => 'Test McTest',
            'tel' => '01234567890',
            'email' => 'test@email.com',
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals('Test McTest', $enquiry->fresh()->contact->name);
        $this->assertEquals(1, $enquiry->fresh()->contact->organisation->contacts->count());
    }
}
