<?php

namespace Tests\Http\Auditor;

use Tests\BrowserKitTest;
use App\Auditor\Tasks\Task;
use App\Jobs\Auditor\ConductAudit;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group auditor
 */
class AuditControllerTest extends BrowserKitTest
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
        parent::dbSeed();
    }

    /** @test */
    function it_dispatches_the_task_to_be_conducted()
    {
        $task = factory(Task::class)->create();
        $this->expectsJobs(ConductAudit::class);
        $this->actingAs($this->superuser())
             ->get("/auditor/audit/{$task->id}");
    }
}
