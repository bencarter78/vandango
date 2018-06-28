<?php

namespace Tests\Unit\UserManager\Roles;

use Tests\TestCase;
use App\UserManager\Roles\Role;
use App\UserManager\Roles\RoleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class RoleRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_all_roles()
    {
        $this->roles();
        $repo = new RoleRepository(new Role());
        $this->assertEquals(1, $repo->getRoles()->count());
    }

    /** @test */
    public function it_updates_a_role()
    {
        $role = $this->roles(1, ['job_role' => 'My Role Name']);
        $repo = new RoleRepository(new Role);
        $repo->update($role->id, ['job_role' => 'My New Role Name']);
        $role = Role::find($role->id);
        $this->assertEquals('My New Role Name', $role->job_role);
    }

    /** @test */
    public function it_returns_all_users_belonging_to_a_role()
    {
        $role = $this->roles();
        $this->users(['roles' => $role->id], 2);
        $repo = new RoleRepository(new Role());
        $this->assertEquals(2, $repo->getRoleStaff($role->id)->users->count());
    }
}