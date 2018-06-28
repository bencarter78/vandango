<?php

namespace Tests\Unit\Judi\Models;

use Tests\TestModel;
use Tests\Traits\Judi;
use App\Judi\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class UserTest extends TestModel
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
    	parent::setUp();
    	$this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_process_linked_to_a_user()
    {
        $processes = $this->processes(3);
        $role = factory(Role::class)->create();
        $role->processes()->attach($processes->pluck('id')->all());
        $user = $this->user();
        $user->roles()->attach($role->id);
        $this->assertEquals(3, $user->assessedProcesses()->count());
    }

    /** @test */
    public function it_returns_all_process_linked_to_a_user_with_multiple_roles()
    {
        $processes = $this->processes(3);
        $role = factory(Role::class)->create();
        $role->processes()->attach($processes->pluck('id')->all());
        $user = $this->user();
        $user->roles()->attach([$this->roles()->id, $role->id]);
        $this->assertEquals(3, $user->assessedProcesses()->count());
    }
}
