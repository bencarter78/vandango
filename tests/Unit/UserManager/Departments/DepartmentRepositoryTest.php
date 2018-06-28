<?php

namespace Tests\Unit\UserManager\Departments;

use Tests\TestCase;
use App\UserManager\Departments\Department;
use App\UserManager\Departments\DepartmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @group usermanager
 */
class DepartmentRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_creates_a_new_department()
    {
        $repo = new DepartmentRepository(new Department);
        $this->assertInstanceOf(Department::class, $repo->create(['department' => 'My New Department']));
    }

    /** @test */
    public function it_updates_a_department()
    {
        $department = $this->departments(1, ['department' => 'My Department Name']);
        $repo = new DepartmentRepository(new Department);
        $repo->update($department->id, [
            'manager_id' => 11,
            'ad_id' => 32,
            'department' => 'My New Department Name',
        ]);

        $department = Department::find($department->id);

        $this->assertEquals('My New Department Name', $department->department);
        $this->assertEquals(11, $department->manager_id);
        $this->assertEquals(32, $department->ad_id);
    }

    /** @test */
    public function it_returns_departments_that_match_a_given_search_term()
    {
        $this->departments(1, ['department' => 'My Department Name']);
        $repo = new DepartmentRepository(new Department);
        $results = $repo->searchByNamePaginated('Department');
        $this->assertEquals(1, $results->count());
    }

    /** @test */
    public function it_returns_departments_that_match_a_given_search_term_paginated()
    {
        $this->departments(1, ['department' => 'My Department Name']);
        $repo = new DepartmentRepository(new Department);
        $results = $repo->searchByNamePaginated('Department', 10);
        $this->assertEquals(1, $results->count());
        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }
}