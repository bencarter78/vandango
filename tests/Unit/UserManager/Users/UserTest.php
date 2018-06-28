<?php

namespace Tests\Unit\UserManager\Users;

use Tests\TestModel;
use App\UserManager\Roles\Role;
use App\UserManager\Users\User;
use App\UserManager\Groups\Group;
use App\UserManager\Sectors\Sector;
use App\UserManager\Users\UserMeta;
use App\UserManager\Departments\Department;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group usermanager
 */
class UserTest extends TestModel
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_returns_the_users_full_name_formatted()
    {
        $user = new User(['first_name' => 'test', 'surname' => 'mcTest']);
        $this->assertEquals('Test McTest', $user->fullName);
    }

    /**  @test */
    function it_returns_true_when_a_user_is_in_a_given_group()
    {
        $group = factory(Group::class)->create();
        $user = $this->user(['groups' => [$group->id]]);

        $this->assertTrue($user->hasAccess($group->slug));
    }

    /** @test */
    function it_returns_true_when_a_user_is_in_a_given_job_role()
    {
        $role = factory(Role::class)->create();
        $user = $this->user(['roles' => [$role->id]]);

        $this->assertTrue($user->hasRole($role->job_role));
    }

    /** @test */
    function it_returns_true_when_a_user_is_a_sector_manager()
    {
        $role = factory(Role::class)->create(['job_role' => 'Department Manager']);
        $department = factory(Department::class)->create();
        $sector = factory(Sector::class)->create();
        $user = $this->user([
            'departments' => [$department->id],
            'sectors' => [$sector->id],
            'roles' => [$role->id],
        ]);

        $this->assertTrue($user->isSectorManager($sector->name));
    }

    /** @test */
    function it_returns_array_of_users_managers_ids()
    {
        $department = factory(Department::class)->create();
        $sector = factory(Sector::class)->create();
        $sector->update(['department_id' => $department->id]);
        $manager = $this->sectorManager(['departments' => $department->id, 'sectors' => $sector->id]);
        $department->update(['manager_id' => $manager->id]);
        $user = $this->user([
            'departments' => [$department->id],
            'sectors' => [$sector->id],
        ]);

        $this->assertContains($manager->id, $user->getLineManagers());
    }

    /** @test */
    function it_returns_array_of_ad_IDs_when_user_is_department_manager()
    {
        $ad = $this->user();
        $department = $this->departments();
        $manager = $this->sectorManager(['departments' => $department->id]);
        $department->update(['manager_id' => $manager->id, 'ad_id' => $ad->id]);

        $this->assertEquals($ad->id, $manager->getLineManagers()->first()[0]);
    }

    /** @test */
    function it_returns_array_of_users_managers()
    {
        $department = factory(Department::class)->create();
        $sector = factory(Sector::class)->create();
        $sector->update(['department_id' => $department->id]);
        $manager = $this->sectorManager(['departments' => $department->id, 'sectors' => $sector->id]);
        $department->update(['manager_id' => $manager->id]);
        $user = $this->user([
            'departments' => [$department->id],
            'sectors' => [$sector->id],
        ]);

        $this->assertContains($manager->id, $user->getManagers()->first()->toArray());
    }

    /** @test */
    function it_returns_array_of_ad_when_user_is_department_manager()
    {
        $department = factory(Department::class)->create();
        $manager = $this->sectorManager(['departments' => $department->id]);
        $ad = $this->user();
        $department->update(['manager_id' => $manager->id, 'ad_id' => $ad->id]);

        $this->assertContains($ad->id, $manager->getManagers()->first()->toArray());
    }

    /** @test */
    function it_returns_true_when_user_is_a_manager()
    {
        $department = factory(Department::class)->create();
        $manager = $this->sectorManager(['departments' => $department->id]);
        $department->update(['manager_id' => $manager->id]);
        $this->assertTrue($manager->isManager());
    }

    /** @test */
    function it_returns_true_when_user_is_ad()
    {
        $department = factory(Department::class)->create();
        $ad = $this->sectorManager(['departments' => $department->id]);
        $department->update(['ad_id' => $ad->id]);
        $this->assertTrue($ad->isManager());
    }

    /** @test */
    function it_returns_true_when_given_user_is_managed_by_current_user()
    {
        $department = factory(Department::class)->create();
        $sector = factory(Sector::class)->create();
        $sector->update(['department_id' => $department->id]);
        $manager = $this->sectorManager(['departments' => $department->id, 'sectors' => $sector->id]);
        $department->update(['manager_id' => $manager->id]);
        $user = $this->user([
            'departments' => [$department->id],
            'sectors' => [$sector->id],
        ]);

        $this->assertTrue($manager->isManagerOf($user));
    }

    /** @test */
    function it_returns_true_when_a_user_is_on_probation()
    {
        $user = factory(User::class)->create();
        $user->meta()->save(new UserMeta([
            'probation_end_date' => date('Y-m-d'),
        ]));

        $this->assertTrue($user->isOnProbation());
    }

    /** @test */
    function it_updates_the_username_when_an_email_has_changed()
    {
        $user = factory(User::class)->create([
            'email' => 'test.mctest@test.com',
            'username' => 'test.mctest',
        ]);

        $user->update([
            'email' => 'testing.mctest@test.com',
            'username' => 'testing.mctest@test.com',
        ]);

        $this->assertEquals('testing.mctest', $user->username);
        $this->assertEquals('testing.mctest@test.com', $user->email);
    }

    /** @test */
    function it_returns_a_unique_username()
    {
        factory(User::class)->create(['username' => 'test.mctest']);
        factory(User::class)->create(['username' => 'test.mctest6']);
        factory(User::class)->create(['username' => 'test.mctest2']);
        factory(User::class)->create(['username' => 'test.mctest72']);
        factory(User::class)->create(['username' => 'test.mctest45']);

        $user = new User();
        $user->setUsernameAttribute('test.mctest@test.com');

        $this->assertEquals('test.mctest73', $user->username);
    }

}
