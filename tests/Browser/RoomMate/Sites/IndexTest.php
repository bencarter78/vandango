<?php

namespace Tests\Browser\RoomMate\Sites;

use Tests\DuskTestCase;
use Tests\Traits\RoomMate;
use Tests\Browser\Pages\AdminActions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group roommate
 */
class IndexTest extends DuskTestCase
{
    use RoomMate, DatabaseMigrations;

    /** @test */
    public function it_lists_all_sites()
    {
        $sites = $this->sites(5);
        $this->browse(function ($browser) use ($sites) {
            $browser->logInAs($this->user())->visit('/roommate/sites');
            $sites->each(function ($site) use ($browser) {
                $browser->assertSee($site->name)->assertSee($site->location->town);
            });
        });
    }
}
