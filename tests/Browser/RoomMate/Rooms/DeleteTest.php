<?php

namespace Tests\Browser\RoomMate\Rooms;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class DeleteTest extends DuskTestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_deletes_a_room()
    {
        $room = $this->rooms();
        $this->browse(function ($browser) use ($room) {
            $browser->logInAs($this->admin('roommate'))
                    ->visit('/roommate/rooms')
                    ->assertSee($room->name)
                    ->click("a[name=delete]")
                    ->whenAvailable('.modal-container', function ($modal) {
                        $modal->press('Delete');
                    })
                    ->assertDontSee($room->name);
        });
    }
}
