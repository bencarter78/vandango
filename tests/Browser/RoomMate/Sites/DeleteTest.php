<?php

namespace Tests\Browser\RoomMate\Sites;

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
    public function it_deletes_a_site()
    {
        $site = $this->sites();
        $this->browse(function ($browser) use ($site) {
            $browser->logInAs($this->admin('roommate'))
                    ->visit('/roommate/sites')
                    ->assertSee($site->name)
                    ->click("a[id=delete_{$site->id}]")
                    ->whenAvailable('.modal', function ($modal) {
                        $modal->press('Delete');
                    })
                    ->assertDontSee($site->name);
        });
    }
}
