<?php

namespace Tests\Unit\Judi\Repositories;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Process;
use App\Exceptions\ProcessExistsException;
use App\Judi\Repositories\ProcessRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class ProcessRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_process()
    {
        $repo = new ProcessRepository(new Process());

        $this->assertInstanceOf(Process::class, $repo->create(['name' => 'My Amazing Process Name']));
    }

    /** @test */
    public function it_does_not_creates_a_new_process_when_it_already_exists()
    {
        $this->expectException(ProcessExistsException::class);

        $data = ['name' => 'My Amazing Process Name'];

        $this->processes(1, $data);

        (new ProcessRepository(new Process()))->create($data);
    }

    /** @test */
    public function it_syncs_the_roles_associated_with_the_process()
    {
        $repo = new ProcessRepository(new Process());
        $process = $repo->create([
            'name' => 'My Process Name',
            'role_id' => $this->roles(3)->pluck('id')->all(),
        ]);

        $this->assertEquals(3, $process->roles->count());
    }

    /** @test */
    public function it_detaches_the_roles_associated_with_the_process()
    {
        $repo = new ProcessRepository(new Process());

        $process = $repo->create(['name' => 'My Process Name']);

        $this->assertEquals(0, $process->roles->count());
    }

    /** @test */
    public function it_updates_the_process()
    {
        $repo = new ProcessRepository(new Process());

        $this->assertInstanceOf(Process::class, $repo->update($this->processes()->id, []));
    }

    /** @test */
    public function it_syncs_the_reports_associated_with_the_process()
    {
        $repo = new ProcessRepository(new Process());

        $process = $repo->update($this->processes()->id, [
            'report_id' => $this->reports(3)->pluck('id')->all(),
        ]);

        $this->assertEquals(3, $process->reports()->count());
    }

    /** @test */
    public function it_detaches_the_reports_associated_with_the_process()
    {
        $repo = new ProcessRepository(new Process());

        $process = $repo->update($this->processes()->id, []);

        $this->assertEquals(0, $process->reports()->count());
    }

    /** @test */
    public function it_returns_all_process_linked_to_given_roles()
    {
        $roleIds = $this->roles(2)->pluck('id')->all();

        $this->processes(3)->first()->roles()->attach($roleIds);

        $repo = new ProcessRepository(new Process(), $this->mock(Request::class));

        $this->assertEquals(1, $repo->getUserProcesses($roleIds)->count());
    }

}
