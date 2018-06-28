<?php

namespace Tests\Browser\RoomMate\Rooms;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use App\RoomMate\Models\Room;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class CreateTest extends DuskTestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_can_create_a_new_room()
    {
        $site = $this->sites();
        $room = $this->make(Room::class, 1, ['site_id' => $site->id]);
        $this->browse(function ($browser) use ($room) {
            $browser->loginAs($this->admin('roommate'))
                    ->visit('roommate/rooms')
                    ->clickLink('Create')
                    ->assertSee('Create Room')
                    ->type('name', $room->name)
                    ->type('capacity', $room->capacity)
                    ->select('site_id', "$room->site_id")
                    ->press('Save')
                    ->assertPathIs('/roommate/rooms')
                    ->waitForText($room->name)
                    ->assertSee($room->name);
        });
    }

    /** @test */
    public function it_displays_errors_when_required_fields_are_missing_from_a_submission()
    {
        $room = $this->make(Room::class);
        $this->browse(function ($browser) use ($room) {
            $browser->loginAs($this->admin('roommate'))
                    ->visit('roommate/rooms/create')
                    ->type('name', $room->name)
                    ->press('Save')
                    ->assertPathIs('/roommate/rooms/create')
                    ->assertInputValue('name', $room->name)
                    ->assertSee("Whoops");
        });
    }
}
