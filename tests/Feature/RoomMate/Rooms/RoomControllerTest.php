<?php

namespace Tests\Feature\RoomMate\Rooms;

use Tests\TestCase;
use Tests\Traits\RoomMate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class RoomControllerTest extends TestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_returns_all_rooms_as_json()
    {
        $room = $this->rooms();
        $response = $this->get('/api/v1/roommate/rooms');
        $response->assertStatus(200)->assertJson([$room->toArray()]);

        $response->assertStatus(200)->assertJson([
            [
                'name' => $room->name,
                'site' => [
                    'location' => ['town' => $room->site->location->town],
                ],
            ],
        ]);
    }
}
