<?php

namespace Tests\Feature\Auditor;

use Tests\TestCase;
use App\Auditor\Tasks\Task;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CloneTaskControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_clones_a_task()
    {
        $task = factory(Task::class)->create(['title' => 'My Example Task']);

        $response = $this->actingAs($this->admin('auditor'))->post(route('auditor.tasks.clone.store'), ['task_id' => $task->id]);
        $tasks = Task::all();

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertEquals(2, $tasks->count());
        $this->assertEquals('My Example Task Copy', $tasks->last()->title);
    }

    /** @test */
    public function only_authorised_users_can_clone_a_task()
    {
        $task = factory(Task::class)->create();

        $response = $this->actingAs($this->user())->post(route('auditor.tasks.clone.store'), ['task_id' => $task->id]);

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertEquals(1, Task::count());
    }
}
