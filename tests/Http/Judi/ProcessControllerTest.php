<?php

namespace Tests\Http\Judi;

use Tests\Traits\Judi;
use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group judi
 */
class ProcessControllerTest extends BrowserKitTest
{
    use DatabaseMigrations, Judi;

    /** @test */
    function it_displays_all_processes_to_the_judiAdmin()
    {
        $processes = $this->processes(5);

        $this->actingAs($this->groupUser(['judiAdmin', 'judi']))
             ->visit('judi/processes')
             ->see('Performance Assessment Processes')
             ->see($processes->first()->name);
    }

    /** @test */
    function it_links_to_create_a_new_process()
    {
        $this->actingAs($this->groupUser(['judiAdmin', 'judi']))
             ->visit('judi/processes')
             ->click('Create Process')
             ->seePageIs('judi/processes/create');
    }

    /** @test */
    function it_adds_a_new_process()
    {
        $report = $this->reports(1);
        $role = $this->roles();

        $this->actingAs($this->groupUser(['judiAdmin', 'judi']))
             ->visit('judi/processes/create')
             ->see('Create A New Process')
             ->submitForm('Create', [
                 'name' => 'My Process Name',
                 'trigger_week' => 18,
                 'role_id' => [$role->id],
                 'report_id' => [$report->id],
             ])
             ->seePageIs('judi/processes')
             ->see('My Process Name')
             ->see('Success');
    }

    /** @test */
    function it_does_not_allow_PAs_to_add_a_new_process()
    {
        $this->actingAs($this->groupUser(['judiPa', 'judi']))
             ->visit('judi/processes/create')
             ->dontSee('Create A New Process');
    }

    /** @test */
    function it_does_not_allow_managers_to_add_a_new_process()
    {
        $this->actingAs($this->groupUser(['judiSM', 'judi']))
             ->visit('judi/processes/create')
             ->dontSee('Create A New Process');
    }
}
