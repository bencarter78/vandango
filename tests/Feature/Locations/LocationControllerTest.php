<?php

namespace Tests\Feature\Locations;

use Tests\TestCase;
use App\Locations\Models\Location;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group locations
 */
class LocationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_updates_a_location()
    {
        $location = factory(Location::class)->create();

        $response = $this->actingAs($this->user())->put('/locations/' . $location->id, [
            'add1' => '123 Test Road',
            'town' => 'Test Town',
        ]);

        $response->assertStatus(302)
                 ->assertSessionHas('success');
    }

    /** @test */
    public function it_removes_a_location()
    {
        $location = factory(Location::class)->create();

        $response = $this->actingAs($this->user())->delete('/locations/' . $location->id);

        $response->assertStatus(302)
                 ->assertSessionHas('success');
    }
}
