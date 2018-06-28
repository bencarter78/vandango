<?php

namespace Tests\Http\Judi;

use Tests\Traits\Judi;
use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group judi
 */
class SummaryControllerTest extends BrowserKitTest
{
    use DatabaseMigrations, Judi;

    /** @test */
    function it_displays_the_outcome_form()
    {
        $manager = $this->groupUser(['judiSM', 'judi']);
        $sector = $this->sectors();
        $manager->sectors()->attach($sector->id);
        $users = $this->sectorSummaries($manager, $sector);

        $this->actingAs($manager)
             ->visit('judi')
             ->see('Summaries Requiring Outcomes')
             ->see($users[0]->first_name);
    }

    /** @test */
    function it_removes_the_entry_when_form_is_submitted()
    {
        $manager = $this->groupUser(['judiSM', 'judi']);
        $sector = $this->sectors();
        $manager->sectors()->attach($sector->id);
        $users = $this->sectorSummaries($manager, $sector);

        $this->actingAs($manager)
             ->visit('/judi')
             ->select('Monitor by manager', 'outcome')
             ->press('Submit')
             ->seePageIs('/judi')
             ->dontSee($users[0]->first_name);
    }

}
