<?php

namespace Tests\Browser\RoomMate\Rooms;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class EditTest extends DuskTestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_can_edit_a_room()
    {
        $site = $this->sites();
        $room = $this->rooms();
        $admin = $this->admin('roommate');
        $this->browse(function ($browser) use ($admin, $site, $room) {
            $browser->logInAs($admin)
                    ->visit('roommate/rooms')
                    ->click('a[name=edit]')
                    ->assertPathIs('/roommate/rooms/' . $room->id . '/edit')
                    ->select('site_id', "$site->id")
                    ->press('Save')
                    ->assertPathIs('/roommate/rooms')
                    ->assertSee('success')
                    ->assertSee($site->name);
        });
    }

    /** @test */
    public function it_can_displays_an_error_when_a_required_field_is_empty()
    {
        $site = $this->sites();
        $room = $this->rooms();
        $admin = $this->admin('roommate');
        $this->browse(function ($browser) use ($admin, $site, $room) {
            $browser->logInAs($admin)
                    ->visit('/roommate/rooms/' . $room->id . '/edit')
                    ->clear('name')
                    ->press('Save')
                    ->assertPathIs('/roommate/rooms/' . $room->id . '/edit')
                    ->assertSee('Whoops');
        });
    }
}
