<?php

namespace Tests\Feature\Auditor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group auditor
 */
class TaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_task()
    {
        $this->actingAs($this->admin('auditor'))
             ->post('/auditor/tasks', [
                 'category_id' => 1,
                 'title' => 'Task Title',
                 'description' => 'Task Description',
                 'sql' => 'Task SQL',
                 'recipients' => 'Task Recipients',
                 'template_id' => 1,
                 'notification' => 'Task Notification',
                 'run_frequency' => 'minute',
             ])
             ->assertRedirect('/auditor/tasks')
             ->assertSessionHas('success', 'You have successfully created a new task.');
    }
}
