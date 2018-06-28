<?php

namespace Tests\Browser\RoomMate\Rooms;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class IndexTest extends DuskTestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_lists_all_rooms()
    {
        $room = $this->rooms();
        $this->browse(function ($browser) use ($room) {
            $browser->loginAs($this->admin('roommate'))
                    ->visit('roommate/rooms')
                    ->assertSee('All Rooms')
                    ->waitForText($room->name)
                    ->assertSee($room->name)
                    ->assertVisible('a[name=edit]');
        });
    }

    /** @test */
    public function it_only_allows_actions_to_be_seen_by_admin()
    {
        $room = $this->rooms();
        $this->browse(function ($browser) use ($room) {
            $browser->loginAs($this->user())
                    ->visit('roommate/rooms')
                    ->waitForText($room->name)
                    ->assertMissing('a[name=edit]');
        });
    }
}
