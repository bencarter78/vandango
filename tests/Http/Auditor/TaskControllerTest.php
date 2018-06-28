<?php

namespace Tests\Http\Auditor;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group auditor
 */
class TaskControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_shows_the_errors_when_creating_a_new_task_with_missing_required_fields()
    {
        $this->actingAs($this->groupUser(['auditorAdmin', 'auditor']))
             ->visit('/auditor/tasks/create')
             ->press('Create')
             ->seePageIs('/auditor/tasks/create')
             ->see('Whoops!');
    }
}
