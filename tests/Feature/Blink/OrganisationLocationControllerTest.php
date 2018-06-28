<?php

namespace Tests\Feature\Blink;

use Tests\TestCase;
use App\Blink\Models\Organisation;
use App\Locations\Models\Location;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class OrganisationLocationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_stores_a_new_organisation_location()
    {
        $organisation = factory(Organisation::class)->create();
        $location = factory(Location::class)->make();

        $this->actingAs($this->user())
             ->post("/blink/organisations/$organisation->id/locations", $location->toArray())
             ->assertStatus(302)
             ->assertSessionHas('success');
    }
}
