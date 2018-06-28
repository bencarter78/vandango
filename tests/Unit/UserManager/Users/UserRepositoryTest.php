<?php

namespace Tests\Unit\UserManager\Users;

use Carbon\Carbon;
use Tests\TestCase;
use App\UserManager\Users\User;
use App\UserManager\Users\UserRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group usermanager
 */
class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_a_user_from_a_given_email_address()
    {
        $user = $this->user();
        $repo = new UserRepository(new User());
        $this->assertInstanceOf(User::class, $repo->findByEmail($user->email));
    }

    /** @test */
    public function it_returns_a_user_from_a_given_username()
    {
        $user = $this->user(['roles' => $this->roles()->id]);
        $repo = new UserRepository(new User());

        $this->assertInstanceOf(User::class, $repo->findByUsername($user->username));
        $this->assertEquals(1, $repo->findByUsername($user->username)->roles->count());
    }

    /** @test */
    public function it_returns_a_user_from_a_given_username_or_id()
    {
        $user = $this->user();
        $repo = new UserRepository(new User());

        $this->assertInstanceOf(User::class, $repo->findByIdOrUsername($user->username));
        $this->assertInstanceOf(User::class, $repo->findByIdOrUsername($user->id));
    }

    /** @test */
    public function it_returns_all_managers_for_a_given_department()
    {
        $sector = $this->sectors();
        $role = $this->roles(1, ['job_role' => config('vandango.usermanager.departments.manager.name')]);
        $this->user(['roles' => $role->id, 'departments' => $sector->department->id,]);
        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getDepartmentManagers($role->id)->count());
    }

    /** @test */
    public function it_returns_all_users_for_a_given_sector()
    {
        $sector = $this->sectors();
        $this->user(['sectors' => $sector->id, 'departments' => $sector->department->id]);
        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getUsersBySector($sector->id)->count());
    }

    /** @test */
    public function it_returns_all_users_for_a_given_role()
    {
        $role = $this->roles();
        $this->user(['roles' => $role->id]);
        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getUsersWithRole($role->id)->count());
        $this->assertEquals(1, $repo->getUsersByRoleId($role->id)->count());
    }

    /** @test */
    public function it_returns_all_users_for_a_given_role_name()
    {
        $role = $this->roles();
        $this->user(['roles' => $role->id]);
        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getUsersByRoleName($role->job_role)->count());
    }

    /** @test */
    public function it_returns_all_directors()
    {
        $dept = $this->departments(1, ['department' => config('vandango.usermanager.departments.directors.name')]);
        $this->user(['departments' => $dept->id]);
        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getDirectors()->count());
    }

    /** @test */
    public function it_returns_all_users_with_a_probation_end_date_of_today()
    {
        $user = $this->user();
        $user->meta->update(['probation_end_date' => date('Y-m-d')]);
        $repo = new UserRepository(new User());

        $this->assertEquals(1, $repo->getAllUsersEndingProbationToday()->count());
    }

    /** @test */
    public function it_returns_all_users_with_a_probation_ending_next_month()
    {
        $date = Carbon::today();
        $users = $this->users([], 2);
        $users[0]->meta->update(['probation_end_date' => $date->startOfMonth()->addMonth()]);
        $users[1]->meta->update(['probation_end_date' => $date->addWeeks(2)]);
        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getAllUsersEndingProbationInMonth()->count());
    }

    /** @test */
    public function it_returns_all_users_on_probation()
    {
        $this->users(['departments' => $this->departments()->id], 2);
        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getAllOnProbation()->count());
    }

    /** @test */
    public function it_returns_all_users_with_an_appraisal_next_month()
    {
        $date = Carbon::today();
        $users = $this->users([], 2);
        $users[0]->meta->update(['appraisal_date' => $date->startOfMonth()->addMonth()]);
        $users[1]->meta->update(['appraisal_date' => $date->addWeeks(2)]);
        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getAllUsersWithAppraisalsInMonth()->count());
    }

    /** @test */
    public function it_returns_all_users_that_started_within_a_given_number_of_days()
    {
        $date = Carbon::today();
        $users = $this->users([], 3);
        $users[0]->meta->update(['start_date' => $date->subDays(10)]);
        $users[1]->meta->update(['start_date' => $date->subDays(5)]);
        $users[2]->meta->update(['start_date' => $date->subDays(50)]);
        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getNewUsers()->count());
    }

    /** @test */
    public function it_returns_all_users_that_left_within_a_given_number_of_days()
    {
        $date = Carbon::today();
        $users = $this->users([], 3);
        $users[0]->deleted_at = $date->subDays(10);
        $users[0]->save();
        $users[1]->deleted_at = $date->subDays(5);
        $users[1]->save();
        $users[2]->deleted_at = $date->subDays(50);
        $users[2]->save();

        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getLeavers()->count());
    }

    /** @test */
    public function it_returns_all_users_with_no_department_assigned()
    {
        $this->users([], 2);
        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getUsersWithNoAssignedDepartment()->count());
    }

    /** @test */
    public function it_returns_all_users_with_a_sector_and_no_assigned_role()
    {
        $sector = $this->sectors();
        $this->users(['sectors' => $sector->id], 2);
        $repo = new UserRepository(new User());

        $this->assertEquals(2, $repo->getSectorStaffWithNoAssignedRole()->count());
    }

    /** @test */
    public function it_returns_all_users_that_match_a_given_search_term()
    {
        factory(User::class)->create(['surname' => 'Fooman']);

        $sector = $this->sectors(1, ['name' => 'FooBar']);
        $this->users(['sectors' => $sector->id], 2);

        $user = $this->user();
        $user->departments()->attach($this->departments(1, ['department' => 'Football'])->id);

        $repo = new UserRepository(new User());

        $this->assertEquals(4, $repo->search('foo')->count());
    }
}