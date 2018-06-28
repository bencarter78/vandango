<?php

namespace Tests\Unit\Console\Commands\Auditor;

use Artisan;
use Tests\TestCase;
use App\Auditor\Tasks\Task;
use App\Jobs\Auditor\ConductAudit;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group auditor
 */
class ManagerTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /**
     * @test
     * @group auditor
     */
    function it_conducts_an_audit_on_a_given_task()
    {
        $this->expectsJobs(ConductAudit::class);
        $task = factory(Task::class)->create();

        Artisan::call('audit:run', ['--id' => $task->id]);
    }
}
