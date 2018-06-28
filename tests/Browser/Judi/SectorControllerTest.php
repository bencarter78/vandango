<?php

namespace Tests\Browser\Judi;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group judi
 */
class SectorControllerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_admin_can_see_all_sectors()
    {
        $sector = $this->sectors();

        $this->browse(function ($browser) use ($sector) {
            $browser->loginAs($this->superuser())
                    ->visit('judi/sectors')
                    ->assertSee($sector->name);
        });
    }

    /** @test */
    public function the_sectors_can_be_filtered()
    {
        $sectors = $this->sectors(2);

        $this->browse(function ($browser) use ($sectors) {
            $browser->loginAs($this->superuser())
                    ->visit('judi/sectors')
                    ->pause(2500)
                    ->type('#search-filter', substr($sectors->first()->name, 0, 4))
                    ->pause(2500)
                    ->assertSee($sectors->first()->name)
                    ->assertDontSee($sectors->last()->name);
        });
    }

    /** @test */
    public function a_manager_can_only_see_their_sectors()
    {
        $manager = $this->groupUser(['judi', 'judiSM']);
        $sector = $this->sectors();
        $manager->departments()->attach($sector->department_id);
        $manager->sectors()->attach($sector->id);
        $manager->sectors->first()->update(['department_id' => $manager->departments->first()->id]);

        $sector = $this->sectors();

        $this->browse(function ($browser) use ($manager, $sector) {
            $browser->loginAs($manager)
                    ->visit('judi/sectors')
                    ->waitForText($manager->sectors->first()->name)
                    ->assertSee($manager->sectors->first()->name)
                    ->assertDontSee($sector->name);
        });
    }
}
