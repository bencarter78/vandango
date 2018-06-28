<?php

namespace Tests\Feature\Api\V1\Blink;

use Tests\TestCase;
use Tests\Traits\Blink;
use App\Blink\Models\Contact;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class ContactControllerTest extends TestCase
{
    use DatabaseTransactions, Blink;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_contacts()
    {
        $contact = $this->contacts(1, ['first_name' => 'Test']);
        $this->actingAs($this->user())
             ->get('/api/v1/blink/contacts')
             ->assertStatus(200)
             ->assertJson(['results' => [$contact->toArray()]]);
    }

    /** @test */
    public function it_returns_all_contacts_that_match_a_given_term()
    {
        $contact = $this->contacts(1, ['first_name' => 'Test']);
        $this->contacts(1, ['first_name' => 'Pete']);
        $this->actingAs($this->user())
             ->json('GET', '/api/v1/blink/contacts', ['q' => 'test'])
             ->assertStatus(200)
             ->assertJsonMissing(['first_name' => 'Pete'])
             ->assertJson(['results' => [$contact->toArray()]]);
    }

    /** @test */
    public function it_saves_a_new_contact()
    {
        $contact = factory(Contact::class)->make();

        $this->json('POST', 'api/v1/blink/contacts', [
            'organisation_id' => $contact->organisation_id,
            'name' => $contact->name,
            'tel' => $contact->tel,
            'email' => $contact->email,
            'job_title' => $contact->job_title,
        ])
             ->assertStatus(Response::HTTP_OK)
             ->assertJson(['data' => $contact->toArray()]);
    }
}
