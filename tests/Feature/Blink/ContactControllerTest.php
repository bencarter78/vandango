<?php

namespace Tests\Feature\Blink;

use Tests\TestCase;
use App\Blink\Models\Contact;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class ContactControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_displays_a_given_contact()
    {
        $contact = $this->create(Contact::class);

        $response = $this->actingAs($this->user())->get('blink/contacts/' . $contact->id);

        $response->assertSee($contact->organisation->name);
    }
}
