<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use App\Blink\Models\Enquiry;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OrganisationEnquiryControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_organisations_with_live_enquiries()
    {
        $enquiry = $this->create(Enquiry::class);

        $response = $this->json('GET', route('api.blink.organisations.enquiries.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment($enquiry->contact->organisation->toArray());
    }

    /** @test */
    public function it_returns_all_organisations_with_enquiry_data()
    {
        $enquiry = factory(Enquiry::class)->create();

        $this->json('GET', route('api.blink.organisations.enquiries.index'), [])
             ->assertStatus(Response::HTTP_OK)
             ->assertJson(['data' => [$enquiry->contact->organisation->toArray()]]);
    }

    /** @test */
    public function it_returns_all_organisations_with_enquiry_data_for_a_given_id()
    {
        $enquiries = factory(Enquiry::class, 2)->create();

        $response = $this->json('GET', route('api.blink.organisations.enquiries.index'), [
            'id' => $enquiries->first()->contact->organisation->id,
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonMissing(['name' => $enquiries->last()->contact->organisation->name])
                 ->assertJson(['data' => $enquiries->first()->contact->organisation->toArray()]);
    }

    /** @test */
    public function it_returns_all_organisations_with_enquiry_data_for_a_given_search_term()
    {
        $enquiries = factory(Enquiry::class, 2)->create();

        $response = $this->json('GET', route('api.blink.organisations.enquiries.index'), [
            'name' => $enquiries->first()->contact->organisation->name,
        ]);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJsonMissing(['name' => $enquiries->last()->contact->organisation->name])
                 ->assertJson(['data' => [$enquiries->first()->contact->organisation->toArray()]]);
    }
}
