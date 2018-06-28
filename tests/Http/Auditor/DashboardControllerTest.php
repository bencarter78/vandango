<?php

namespace Tests\Http\Auditor;

use Tests\BrowserKitTest;
use App\Auditor\Tasks\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group auditor
 */
class DashboardControllerTest extends BrowserKitTest
{
    use DatabaseMigrations;

    /** @test */
    function it_displays_a_list_of_the_available_tasks()
    {
        $tasks = factory(Task::class, 5)->create();
        $tasks->first()->save();

        $this->actingAs($this->groupUser(['auditorAdmin', 'auditor']))
             ->get('auditor')
             ->see($tasks->first()->title)
             ->see($tasks->first()->recipients);
    }
}
