<?php

namespace Tests\Unit\UserManager\Departments;

use Tests\TestCase;
use App\UserManager\Users\User;
use App\UserManager\Departments\Department;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DepartmentTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_has_a_director()
    {
        $director = factory(User::class)->create();
        $department = factory(Department::class)->create(['ad_id' => $director->id]);

        $this->assertTrue($department->director->is($director));
    }

    /** @test */
    public function it_has_a_manager()
    {
        $manager = factory(User::class)->create();
        $department = factory(Department::class)->create(['manager_id' => $manager->id]);

        $this->assertTrue($department->manager->is($manager));
    }
}
