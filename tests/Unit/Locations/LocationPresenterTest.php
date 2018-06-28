<?php

namespace Tests\Unit\Locations;

use Tests\TestCase;
use App\Locations\Models\Location;

/**
 * @group locations
 */
class LocationPresenterTest extends TestCase
{
    /** @test */
    public function it_displays_the_location_address()
    {
        $location = factory(Location::class)->make();
        $this->assertEquals(
            "$location->add1, $location->town, $location->county, $location->postcode",
            $location->present()->address
        );
    }
}
