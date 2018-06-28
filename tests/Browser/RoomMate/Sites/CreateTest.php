<?php

namespace Tests\Browser\RoomMate\Sites;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use App\RoomMate\Models\Site;
use App\Locations\Models\Location;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class CreateTest extends DuskTestCase
{
    use DatabaseMigrations, RoomMate;

    /** @test */
    public function it_can_create_a_site()
    {
        $site = $this->make(Site::class);
        $location = $this->make(Location::class);
        $admin = $this->admin('roommate');
        $this->browse(function ($browser) use ($admin, $site, $location) {
            $browser->logInAs($admin)
                    ->visit('roommate/sites')
                    ->clickLink('Create')
                    ->assertPathIs('/roommate/sites/create')
                    ->type('name', $site->name)
                    ->type('add1', $location->add1)
                    ->type('add2', $location->add2)
                    ->type('add3', $location->add3)
                    ->type('town', $location->town)
                    ->type('county', $location->county)
                    ->type('postcode', $location->postcode)
                    ->type('tel', $site->tel)
                    ->select('is_owned', "1")
                    ->select('has_disabled_access', "0")
                    ->select('opens_at', $site->opens_at->format('H:i'))
                    ->select('closes_at', $site->closes_at->format('H:i'))
                    ->type('parking', $site->parking)
                    ->press('Save')
                    ->assertPathIs('/roommate/sites')
                    ->assertSee('success')
                    ->assertSee($site->name)
                    ->assertSee($location->town);
        });
    }


    /** @test */
    public function it_returns_back_when_required_fields_are_missing()
    {
        $site = $this->make(Site::class);
        $location = $this->make(Location::class);
        $admin = $this->admin('roommate');
        $this->browse(function ($browser) use ($admin, $site, $location) {
            $browser->logInAs($admin)
                    ->visit('/roommate/sites/create')
                    ->waitForText('Name')
                    ->press('Save')
                    ->assertSee('Whoops');
        });
    }
}
