<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OrganisationContactControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_contacts_from_an_organisation()
    {
        $contact = $this->create(Contact::class);

        $response = $this->get("/api/v1/blink/organisations/{$contact->organisation->id}/contacts");

        $response->assertStatus(200);
        $response->assertJsonFragment(['first_name' => $contact->first_name]);
    }
}
