<?php

namespace Tests\Browser\RoomMate\Sites;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use App\Locations\Models\Location;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class EditTest extends DuskTestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_can_edit_a_site()
    {
        $site = $this->sites();
        $location = $this->make(Location::class);
        $admin = $this->admin('roommate');
        $this->browse(function ($browser) use ($admin, $site, $location) {
            $browser->logInAs($admin)
                    ->visit('roommate/sites')
                    ->click('a[name=edit]')
                    ->assertPathIs('/roommate/sites/' . $site->id . '/edit')
                    ->type('town', $location->town)
                    ->press('Save')
                    ->assertPathIs('/roommate/sites')
                    ->assertSee('success')
                    ->assertSee($location->town);
        });
    }

    /** @test */
    public function it_can_displays_an_error_when_a_required_field_is_empty()
    {
        $site = $this->sites();
        $location = $this->make(Location::class);
        $admin = $this->admin('roommate');
        $this->browse(function ($browser) use ($admin, $site, $location) {
            $browser->logInAs($admin)
                    ->visit('roommate/sites')
                    ->click('a[name=edit]')
                    ->type('town', '')
                    ->press('Save')
                    ->assertPathIs('/roommate/sites/' . $site->id . '/edit')
                    ->assertSee('Whoops');
        });
    }
}
