<?php

namespace Tests\Unit\Judi\Repositories;

use Tests\TestCase;
use Tests\Traits\Judi;
use App\Judi\Models\Role;
use App\Judi\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group judi
 */
class RoleRepositoryTest extends TestCase
{
    use DatabaseTransactions, Judi;

    public function setUp()
    {
        parent::setUp();
        parent::dbSetUp();
    }

    /** @test */
    public function it_returns_all_roles_with_processes()
    {
        factory(Role::class)->create()->processes()->attach($this->processes()->id);

        $this->assertEquals(1, (new RoleRepository(new Role()))->getPaRoles()->count());
    }

    /** @test */
    public function it_returns_all_roles_which_have_processes()
    {
        factory(Role::class)->create()->processes()->attach($this->processes()->id);

        $this->assertInstanceOf(Collection::class, (new RoleRepository(new Role()))->getPaRoles());
    }

    /** @test */
    public function it_returns_all_processes_for_a_given_role()
    {
        $role = factory(Role::class)->create();
        $role->processes()->attach($this->processes()->id);

        $this->assertInstanceOf(Collection::class, (new RoleRepository(new Role()))->getProcesses($role));
        $this->assertEquals(1, (new RoleRepository(new Role()))->getProcesses($role)->count());
    }
}
