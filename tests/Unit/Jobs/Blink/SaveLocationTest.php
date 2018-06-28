<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Jobs\Blink\SaveLocation;
use App\Locations\Models\Location;
use App\Blink\Models\Organisation;
use App\Exceptions\LocationHasNoOwnerException;

/**
 * @group blink
 */
class SaveLocationTest extends TestCase
{
    /** @test */
    public function it_returns_a_location_linked_to_an_owner()
    {
        $owner = $this->mock(Organisation::class);
        $owner->shouldReceive('getAttribute')->with('id')->once();

        $model = $this->mock(Location::class);
        $model->shouldReceive('firstOrCreate')->once()->andReturnSelf();

        $job = new SaveLocation([
            'location_owner' => $owner,
            'add1' => '123 Test Lane',
        ]);
        $this->assertInstanceOf(Location::class, $job->handle($model));
    }

    /** @test */
    public function it_throws_an_exception_when_no_owner_is_given()
    {
        $this->expectException(LocationHasNoOwnerException::class);
        $job = new SaveLocation([]);
        $job->handle(new Location());
    }
}
